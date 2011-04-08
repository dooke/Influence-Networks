{include file="header.tpl"}

{if $ecran=="relation-add"}

      {include file="ecran/relation-add.tpl"}
      
{elseif $ecran=="relation-review"}

      {include file="ecran/relation-review.tpl"}     
      
{elseif $ecran=="relation-visualise"}

      {include file="ecran/relation-visualise.tpl"}
      
{else}

      {include file="ecran/homepage.tpl"}
      
{/if}

{include file="footer.tpl"}