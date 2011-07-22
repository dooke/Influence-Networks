{if $page}
    <div class="main">
        <h2>{$page->title}</h2>
        <article class="content">
            {$page->content}
        </article>
        <span class="breaker"></span>
    </div>
{/if}