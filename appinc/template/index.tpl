{include file="header.tpl"}

{if $screen=="relation-add"}

      {include file="screen/relation-add.tpl"}
      
{elseif $screen=="relation-review"}

      {include file="screen/relation-review.tpl"}     
      
{elseif $screen=="relation-visualise"}

      {include file="screen/relation-visualise.tpl"}
      
{else}

      {include file="screen/homepage.tpl"}
      
{/if}

{include file="footer.tpl"}