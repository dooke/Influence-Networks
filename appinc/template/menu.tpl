{if $isConnected}
      <li  class="add {if $screen=='relation-add'}current{/if}" title="{t}Add a relation between 2 nodes.{/t}">
            <a href="{$smarty.const.APP_URL}?screen=relation-add" class="label">
                  {t}Add a relation{/t}
            </a>
      </li>
      <li class="review {if $screen=='relation-review'}current{/if}" title="{t}See a random relation between 2 nodes to estimate its trust level.{/t}">
            <a href="{$smarty.const.APP_URL}?screen=relation-review" class="label">
                  {t}Review a relation{/t}
            </a>
      </li>
{else}
      <li  class="add disabled {if $screen=='relation-add'}current{/if}" title="{t}(log in to use this feature) Add a relation between 2 nodes.{/t}">
            <span class="label">
                  {t}Add a relation{/t}
            </span>
      </li>
      <li class="review disabled {if $screen=='relation-review'}current{/if}" title="{t}(log in to use this feature) See a randomize relation between 2 nodes to estimate its trust level.{/t}">
            <span class="label">
                  {t}Review a relation{/t}
            </span>
      </li>
{/if}
<li class="visualise {if $screen=='relation-visualise'}current{/if}"  title="{t}See entities relations.{/t}">
      <a href="{$smarty.const.APP_URL}?screen=relation-visualise" class="label">
            {t}Visualize a relation{/t}
      </a>
</li>