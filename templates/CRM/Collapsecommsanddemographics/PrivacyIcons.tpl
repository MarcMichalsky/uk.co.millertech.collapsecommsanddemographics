{strip}
    {foreach from=$privacy item=priv key=index}
        {if $priv}{privacyFlag field=$index}{/if}
    {/foreach}
    {if $is_opt_out}{privacyFlag field="is_opt_out"}{/if}
{/strip}