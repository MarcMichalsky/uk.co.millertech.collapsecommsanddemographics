<div class="collapsedcommsanddemos ccnd-demos crm-collapsible collapsed ui-corner-all">
    <div class="collapsible-title">
        {ts}Demographics{/ts}
        <span class="ccnd_demo_extra_content">
            {include file="CRM/Collapsecommsanddemographics/DemographicIcons.tpl"}
        </span>
    </div>
    <div class="crm-summary-demographic-block">
        <div class="crm-summary-block" id="demographic-block">
            {include file="CRM/Contact/Page/Inline/Demographics.tpl"}
        </div>
    </div>
</div>
{literal}
    <style>
        #crm-container .collapsedcommsanddemos.ccnd-demos .ccnd_demo_extra_content span.privacy-flag.demography-icon {
            text-align: center;
            float: none;
            position: relative;
            display: inline-block;
            width: auto;
            min-width: 1.5em;
            height: 1.5em;
            line-height: 1.5em;
            vertical-align: middle;
        }

    </style>
<script>
    CRM.$(function ($) {
        CRM.$("#demographic-block").on("crmFormSuccess", function (e) {
            $(".collapsedcommsanddemos.ccnd-demos .ccnd_demo_extra_content").block();
            $.get(CRM.url('civicrm/collapsecommsanddemographics/ajax/demographics', {cid: {/literal}{$contactId}{literal}}))
                .then(function (result) {
                    $(".collapsedcommsanddemos.ccnd-demos .ccnd_demo_extra_content").unblock().html(result);
                });
        });
    });
</script>
{/literal}
