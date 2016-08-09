#!/usr/bin/env bash

function barf
{
    printf '%b' "\e[1;91mfailed\e[0m\nWP Boostrap: ${1:-"Unknown Error"}\n" 1>&2
    echo
	exit 1
}

# 1. get install dir
# a. acquire
printf '%b' "Where do you want everything installed? "
read INSTALL_DIR

# b. check presence
if [ -z $INSTALL_DIR ]; then
    printf '%b' "Error: you must specify an installation location.\n\n"
    exit 1
fi

# c. check existence
if [ -d $INSTALL_DIR ]; then
    printf '%b' "\e[1;91mWarning\e[0m: your installation destination already exists. Exiting\n\n"
    exit 2
fi
INSTALL_DIR=$(pwd)/$INSTALL_DIR

# 2. theme name
# a. acquire
printf '%b' "Enter theme name [$(basename $INSTALL_DIR )]: "
read THEME_NAME

# b. zero
if [ -z $THEME_NAME ]; then
    THEME_NAME=$(basename $INSTALL_DIR)
fi

# 2. create our install dir
mkdir $INSTALL_DIR && cd $INSTALL_DIR

# 3. Job done: output a wait message, and get going
echo
echo "Bootstrapping Wordpress. This may take some time: fetch a coffee…"
echo
printf '%b' "* \e[1;33mINFO:\e[0m installing to \e[1m$INSTALL_DIR\e[0m. If this is wrong, hit control-C NOW!\n"
printf '%b' "* \e[1;33mINFO:\e[0m Giving you a few seconds to make sure you’re happy. 5"
sleep 1
printf '%b' "\b4"
sleep 1
printf '%b' "\b\e[1;93m3\e[0m"
sleep 1
printf '%b' "\b\e[1;91m2\e[0m"
sleep 1
printf '%b' "\b\e[1;91m1\e[0m"
sleep 1
printf '%b' "\b \n* \e[1;33mINFO\e[0m: OK—making it so!";
echo
echo

# a. trellis
printf '%b' "* Cloning trellis… "
cd $INSTALL_DIR && git clone --quiet --depth=1 git@github.com:roots/trellis.git 2> /dev/null && rm -rf trellis/.git || barf "could not clone Trellis—please ensure you’ve uploaded your SSH key to github"
printf '%b' "done\n"

# b. clone bedrock and run composer
printf '%b' "* Cloning bedrock… "
cd $INSTALL_DIR && git clone --quiet --depth=1 git@github.com:roots/bedrock.git site && rm -rf site/.git || barf "could not clone Bedrock—please ensure you’ve uploaded your SSH key to github"
printf '%b' "done\n  - Updating… "
cd $INSTALL_DIR/site && composer -q update > /dev/null 2>&1
printf '%b' "done\n"

# c. install ansible roles
printf '%b' "* Installing ansible-galaxy (this will take time)… "
cd $INSTALL_DIR/trellis && ansible-galaxy install -r requirements.yml > /dev/null 2>&1 || barf "could not run ansible-galaxy—have you made sure it’s installed?"
printf '%b' "done\n"

# d. base theme
printf '%b' "* Cloning Mr B WP theme… "
cd $INSTALL_DIR/site/web/app/themes && git clone --quiet --recursive git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/mrb-wordpress-theme.git $THEME_NAME > /dev/null 2>&1 || barf "could not clone the boilerplate theme—please ensure you have access to the repo"
printf '%b' "done\n"
printf '%b' "  - Updating assets… "
cd $INSTALL_DIR/site/web/app/themes/$THEME_NAME && git submodule foreach git pull origin master --quiet > /dev/null || barf "um…?"
printf '%b' "done\n"

# e. tidy up
printf '%b' "* Tidying… "
cd $INSTALL_DIR/site && find . -name \.git | xargs rm -rf || barf "wat?"
printf '%b' "done\n\n"
