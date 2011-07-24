
{if $isConnected}
      <li  class="add {if $screen=='relation-add'}current{/if}">
            {t}Get involved{/t}
            <a href="{$smarty.const.APP_URL}?screen=relation-add" class="item-button" title="{t}Add a relation between 2 nodes.{/t}">
                  {t}Contribute{/t}
            </a>
      </li>
      <li class="review {if $screen=='relation-review'}current{/if}">
            <a href="{$smarty.const.APP_URL}?screen=relation-review" class="item-button"  title="{t}See a random relation between 2 nodes to estimate its trust level.{/t}">
                  {t}Review{/t}
            </a>
      </li>
{else}
      <li  class="add disabled {if $screen=='relation-add'}current{/if}">
            {t}Get involved{/t}
            <span class="item-button"  title="{t}(log in to use this feature) Add a relation between 2 nodes.{/t}">
                  {t}Contribute{/t}
            </span>
      </li>
      <li class="review disabled {if $screen=='relation-review'}current{/if}">
            <span class="item-button"  title="{t}(log in to use this feature) See a randomize relation between 2 nodes to estimate its trust level.{/t}">
                  {t}Review{/t}
            </span>
      </li>
{/if}

<li class="visualise {if $screen=='relation-visualize'}current{/if}">
      <a href="{$smarty.const.APP_URL}?screen=relation-visualize" class="label"   title="{t}See entities relations.{/t}">
            {t}Explore{/t}
      </a>
      <form  class="search-field" action="{$smarty.const.APP_URL}">
          <input type="text" name="search" placeholder="{t}Type a person's name{/t}" class="text" />
          <input type="submit" value="search" class="submit" />
      </form>
</li>
<li class="hp">
    <a href="{$smarty.const.APP_URL}">
        {t}Home{/t}
    </a>
</li>
