{strip}
    {if $gender_id}{demographyIcon field="gender" value=$gender_id}{/if}
    {if $age && !$is_deceased}{demographyIcon field="age" value=$age}{/if}
{/strip}