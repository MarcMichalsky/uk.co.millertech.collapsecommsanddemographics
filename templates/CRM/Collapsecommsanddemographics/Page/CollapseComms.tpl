<div class="collapsedcommsanddemos ccnd-comms crm-collapsible collapsed ui-corner-all">
    <div class="collapsible-title">
        {ts}Communication Preferences{/ts}
        <span class="ccnd_demo_extra_content">
            {include file="CRM/Collapsecommsanddemographics/PrivacyIcons.tpl"}
        </span>
    </div>
    <div class="crm-summary-comm-pref-block">
        <div class="crm-summary-block" id="communication-pref-block">
            {include file="CRM/Contact/Page/Inline/CommunicationPreferences.tpl"}
        </div>
    </div>
</div>
{literal}
    <style>
        #crm-container .collapsedcommsanddemos.ccnd-comms .ccnd_demo_extra_content span.privacy-flag {
            float: none;
        }
    </style>
<script>
    CRM.$(function ($) {
        $("#communication-pref-block").on("crmFormSuccess", function (e) {
            $(".collapsedcommsanddemos.ccnd-comms .ccnd_demo_extra_content").block();
            $.get(CRM.url('civicrm/collapsecommsanddemographics/ajax/commsandprefs', {cid: {/literal}{$contactId}{literal}}))
                .then(function (result) {
                    $(".collapsedcommsanddemos.ccnd-comms .ccnd_demo_extra_content").unblock().html(result);
            });
        });
    });
</script>
{/literal}