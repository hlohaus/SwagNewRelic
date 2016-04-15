{block name='frontend_index_header_meta_tags'}
    {newrelic_get_browser_timing_header()}
    {$smarty.block.parent}
{/block}
{block name="frontend_index_header_javascript_jquery"}
    {$smarty.block.parent}
    {newrelic_get_browser_timing_footer()}
{/block}
