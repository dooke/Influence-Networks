{include file="header.tpl"}

{if $ecran=="relation-add"}

      {include file="screen/relation-add.tpl"}
      
{elseif $ecran=="relation-review"}

      {include file="screen/relation-review.tpl"}     
      
{elseif $ecran=="relation-visualise"}

      {include file="screen/relation-visualise.tpl"}
      
{else}

      {include file="screen/homepage.tpl"}
      
{/if}

{include file="footer.tpl"}