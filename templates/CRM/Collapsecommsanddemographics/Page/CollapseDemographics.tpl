<div class="collapsedcommsanddemos ccnd-demos crm-collapsible collapsed ui-corner-all">
    <div class="collapsible-title">
        {ts}Demographics{/ts}<span class="ccnd_demo_extra_content"> <span
                class="crm-i {if $ccnd_show_gender_icon == 'Male'}fa-male{elseif $ccnd_show_gender_icon == 'Female'}fa-female{/if}"></span>
            <span class="ccnd-demos-age">{if $ccnd_show_age} {$ccnd_show_age}{/if}</span> </span>
    </div>
    <div class="crm-summary-demographic-block">
        <div class="crm-summary-block" id="demographic-block">
            {include file="CRM/Contact/Page/Inline/Demographics.tpl"}
        </div>
    </div>
</div>
{literal}
    <script>
        CRM.$(function () {
            CRM.$("#demographic-block").on("crmFormSuccess", function (event, data) {
                setTimeout(function () {
                    var gender_display = CRM.$(".crm-contact-gender_display").text().trim();
                    var birthdate = CRM.$(".crm-contact-birth_date_display").text().trim();
                    var deceased = CRM.$(".crm-contact-deceased_message").text().trim();
                    var deceased_date = CRM.$(".crm-contact-deceased_date_display").text().trim();
                    if (gender_display == 'Male') {
                        CRM.$(".ccnd-demos .ccnd_demo_extra_content span.crm-i").removeClass("fa-female").addClass("fa-male");
                    } else if (gender_display == 'Female') {
                        CRM.$(".ccnd-demos .ccnd_demo_extra_content span.crm-i").removeClass("fa-male").addClass("fa-female");
                    } else {
                        CRM.$(".ccnd-demos .ccnd_demo_extra_content span.crm-i").removeClass("fa-male fa-female");
                    }
                    if (birthdate != "" && deceased == "" && deceased_date == "") {
                        // remove date suffix
                        var mapObj = {
                            nd: "",
                            st: "",
                            th: "",
                            rd: ""
                        };
                        birthdate = birthdate.replace(/nd|st|th|rd/gi, function (matched) {
                            return mapObj[matched];
                        });
                        var dob = new Date(birthdate);
                        var today = new Date();
                        var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                        CRM.$(".ccnd-demos-age").text(age);
                    } else {
                        CRM.$(".ccnd-demos-age").text("");
                    }
                }, 1000);
            });
        });
    </script>
{/literal}