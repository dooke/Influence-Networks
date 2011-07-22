<div class="main">
    
    <h2 class="fhidden">Homepage</h2>
    <section class="introdcution">            
        <object width="560" height="349"  class="video" >
            <param name="movie" value="http://www.youtube.com/v/{$intro->custom_fields->yt[0]}version=3&amp;hl=fr_FR&amp;rel=0"></param>
            <param name="allowFullScreen" value="true"></param>
            <param name="allowscriptaccess" value="always"></param>
            <param name="wmode" value="transparent"></param>
            <embed src="http://www.youtube.com/v/{$intro->custom_fields->yt[0]}?version=3&amp;hl=fr_FR&amp;rel=0" wmode="transparent" type="application/x-shockwave-flash" width="560" height="349" allowscriptaccess="always" allowfullscreen="true"></embed>
        </object>
        <h3>{$intro->title}</h3>
        <article>            
            {$intro->content}
        </article>
    </section>

    <span class="breaker"></span>

    <section class="profession journalists">
        <h3>Influence Networks <big>for Journalists</big></h3>
        <article>
            {$forJournalists->content}
        </article>
    </section>

    <section class="profession citizens">
        <h3>Influence Networks <big>for Citizens</big></h3>
        <article>
            {$forCitizens->content}
        </article>
    </section>

    <section class="profession developers ">
        <h3>Influence Networks <big>for Developers</big></h3>
        <article>
            {$forDevelopers->content}
        </article>
    </section>

</div>

<span class="breaker"></span>

<section class="in-the-news">
    <h3>{t}Influence Networks in the News{/t}</h3>        
    <ul class="main">
        <li>
            <a target="_blank"><img src="./appinc/images/infnets.png" /></a>
            <blockquote>Sem quis congue suscipit, augue nulla.</blockquote>
            <p><strong>The Guardian,</strong> December 18th, 2011</p>
        </li>
        <li class="last">
            <a target="_blank"><img src="./appinc/images/infnets.png" /></a>
            <blockquote>Sem quis congue suscipit, augue nulla.</blockquote>
            <p><strong>The Guardian,</strong> December 18th, 2011</p>
        </li>
        <li>
            <a target="_blank"><img src="./appinc/images/infnets.png" /></a>
            <blockquote>Sem quis congue suscipit, augue nulla.</blockquote>
            <p><strong>The Guardian,</strong> December 18th, 2011</p>
        </li>
        <li class="last">
            <a target="_blank"><img src="./appinc/images/infnets.png" /></a>
            <blockquote>Sem quis congue suscipit, augue nulla.</blockquote>
            <p><strong>The Guardian,</strong> December 18th, 2011</p>
        </li>
    </ul>
    <span class="breaker"></span>
</section>
