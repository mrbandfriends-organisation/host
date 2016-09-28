<?php

namespace Roots\Sage\Titles;
use Roots\Sage\Utils;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'sage');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'sage');
  } else {
    return get_the_title();
  }
}

function split_line_header($sTag, $sText, $sAdditionalClass = '')
{
    // 0. flag
    $bHasSpan = false;
    $bInSpan  = false;

    // 1. text formatting
    // a. make everything HTML safe
    $sText = esc_html($sText);

    // b. do this as an array, because it’s easier…
    $aText = preg_split('/\n+/', $sText);

    // c. enspan things
    $aText = array_map(function($sLine) use (&$bHasSpan, &$bInSpan)
    {
        // i. trim
        $sLine = trim($sLine);

        // ii. if we have sufficient asterisks
        $bHasAst = preg_match('/\*.+\*/', $sLine);
        if (!$bHasAst)
        {
            $bInSpan = false;
        }

        // iii. trim
        $sLine = str_replace('*', '', $sLine);

        // iv. if there’re no asterisks, or there are, but it’s too late…
        if (!$bHasAst || ($bHasAst && $bHasSpan && !$bInSpan))
        {
            return $sLine;
        }

        // v. otherwise, set some flags and output
        $bHasSpan = true;
        $bInSpan  = true;

        return "<span>{$sLine}</span>";
    }, $aText);

    // d. join everything together
    $sText = join('<br>', $aText);

    // e. finally, remove </span><br><span> formations because they’re icky
    $sText = str_replace('</span><br><span>', '<br>', $sText);
    $sText = str_replace('</span><br>', '</span> ', $sText);

    // 2. start generating outputtable HTML
    $sClass = $sAdditionalClass.($bHasSpan ? " plain" : '');

    // 3. tag!
    return Utils\tag($sTag, [ 'class' => trim($sClass) ], $sText, true);
}
