<p>&nbsp;</p><p>&nbsp;</p>
<h2>Search Commander Inc. Report for {$url}</h2>
<table id="overview">
	<tbody>
		<tr class="even" style="font-size:14px;font-weight:bold;">
			<td>{$heading_overview}</td>
			<td style="color:red;text-align:center;">&bull; {if !empty($results->ugly)}<a style="color:red;" href="#critical"> {$results->ugly_count} {$heading_critical}</a>{else}{$results->ugly_count} {$heading_critical}{/if}</td>
			<td style="color:orange;text-align:center;">&bull; {if !empty($results->bad)}<a style="color:orange;" href="#problems">{$results->bad_count} {$heading_problem}</a>{else}{$results->bad_count} {$heading_problem}{/if}</td>
			<td style="color:green;text-align:center;">&bull; {if !empty($results->good)}<a style="color:green;"href="#correct">{$results->good_count} {$heading_correct} </a>{else}{$results->good_count} {$heading_correct}{/if}</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
{if $title_enable || $description_enable || $h1_status_enable || $h2_status_enable || $keywords_enable || $image_dimensions_enable || $expires_headers_enable || $robots_enable}
<h4>Meta Information</h4>

<table id="meta_tags">
	{if $title_enable}
	<tr class="{cycle name=trbg values='even,odd'}">
		<td colspan="2" class="subject">Title Tag<p class="tooltip">{$locale.title.tooltip}</p>
		{if $results->title}
			<div class="message">
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
				{$locale.title.correct} 
				<br><br>
					
				<em>{$results->title}</em>
			</div>
		{else}
			<div class="message">	
			{if $locale.title.important}
				<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}
				<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}
			{$locale.title.problem}</div>
		{/if}
		</td>
	</tr>
	{/if}
	
{if $description_enable}
{foreach from=$results->meta item=meta_tag}
	{if $meta_tag->getAttribute('name') == 'description'}
		<tr class="{cycle name=trbg}">
			<td colspan="2" class="subject">Description Tag<p class="tooltip">{$locale.description.tooltip}</p>
			<div class="message">
	   			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
	   			{$locale.description.correct} <br/><br/>
	   			<em>{$meta_tag->getAttribute('content')}</em>	
			</div>
			</td>
		</tr>
		{/if}
{/foreach}
{if !$results->meta_description}
<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">Description Tag<p class="tooltip">{$locale.description.tooltip}</p>
	<div class="message">
	{if $locale.description.important}
		<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
	{else}
	<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
	{/if}
	{$locale.description.problem}
	</div>
	</td>
</tr>
{/if}
{/if}
{if $keywords_enable}
{foreach from=$results->meta item=meta_tag}
{if $meta_tag->getAttribute('name') == 'keywords'}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">Keyword Tag<p class="tooltip">{$locale.keywords.tooltip}</p>
		
		<div class="message">
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
			{$locale.keywords.correct}<br><br>
			<em>{$meta_tag->getAttribute('content')}</em>
		</div></td>
	</tr>	
{/if}
{/foreach}
{if !$results->meta_keywords}
<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">Keyword Tag<p class="tooltip">{$locale.keywords.tooltip}</p>
	
	<div class="message">
		{if $locale.keywords.important}
			<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
		{else}
			<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
		{/if}
		{$locale.keywords.problem}
	</div></td>
</tr>	
{/if}
{/if}

{if $h1_status_enable}
<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">H1 Header Tag<p class="tooltip">{$locale.h1_status.tooltip}</p>
	<div class="message">
		
		{if $results->h1}
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.h1_status.correct}<br><br>
			{foreach from=$results->h1 item=h1}
				<em>{$h1->textContent}</em><br/>
			{/foreach}
		{else}		
			{if $locale.h1_status.important}
				<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}
				<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}
			{$locale.h1_status.problem}
		{/if}</div></td>
		</tr>
{/if}
{if $h2_status_enable}
<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">H2 Header Tag<p class="tooltip">{$locale.h2_status.tooltip}</p>
	<div class="message">
		
			{if $results->h2}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.h2_status.correct}<br><br>
				{foreach from=$results->h2 item=h2}
					<em>{$h2->textContent}</em><br/>
				{/foreach}
			{else}		
				{if $locale.h2_status.important}
					<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}
					<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				{$locale.h2_status.problem}
			{/if}
			
			</div></td>
		</tr>
{/if}

{if $image_dimensions_enable}
		<tr class="{cycle name=trbg}">
			<td colspan="2" class="subject">Image Height &amp; Width Tags{if !$pdf}<p class="tooltip">{$locale.image_dimensions.tooltip}</p>{/if}
			<div class="message">
				{if $results->image_dimensions}
					<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.image_dimensions.correct}
				{else}
					{if $locale.image_dimensions.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
					{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
					{/if}{$locale.image_dimensions.problem}
				{/if}
			</div></td>
		</tr>
{/if}
{if $expires_headers_enable}
		<tr class="{cycle name=trbg}">
			<td colspan="2" class="subject">Images Expires headers{if !$pdf}<p class="tooltip">{$locale.expires_headers.tooltip}</p>{/if}
			<div class="message">
				{if $results->expires_headers}
					<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.expires_headers.correct}
				{else}
					{if $locale.expires_headers.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
					{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
					{/if}{$locale.expires_headers.problem}
				{/if}
			</div></td>
		</tr>
{/if}
{if $robots_enable}
{foreach from=$results->meta item=meta_tag}
	{if $meta_tag->getAttribute('name') == 'robots'}
		<tr class="{cycle name=trbg}">
			<td colspan="2" class="subject">Robots Meta Tag<p class="tooltip">{$locale.robots.tooltip}</p>
			<div class="message">
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
				{$locale.robots.correct} <p>
				<em>{$meta_tag->getAttribute('content')}</em>
			</div></td>
		</tr>	
	{/if}
{/foreach}
{if !$results->meta_robots}
<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">Robots Meta Tag<p class="tooltip">{$locale.robots.tooltip}</p>
	<div class="message">
	{if $locale.robots.important}
		<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
	{else}
	<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
	{/if}
	{$locale.robots.problem}
	</div></td>
</tr>
{/if}
{/if}

</table>
{/if}

{if $robots_txt_enable || $sitemap_xml_enable || $canonical_url_enable || $canonical_tag_enable || $nested_tables_enable || $inline_styles_enable || $inline_script_enable || $favicon_enable || $favicon_linked_enable  || $google_earth_enable || $rel_author_enable}
<h4>Miscellaneous:</h4>

<table id="page_notes">
{if $robots_txt_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">robots.txt<p class="tooltip">{$locale.robots_txt.tooltip}</p>
		<div class="message">
			{if $results->robots_txt}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" /> {$locale.robots_txt.correct}
			{else}	{if $locale.robots_txt.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				 {$locale.robots_txt.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $sitemap_xml_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">XML sitemap file<p class="tooltip">{$locale.sitemap_xml.tooltip}</p>
		<div class="message">
		{if $results->sitemap_xml}
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.sitemap_xml.correct}
		{else}{if $locale.sitemap_xml.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}{$locale.sitemap_xml.problem}
		{/if}
		</div></td>
	</tr>
{/if}
{if $google_earth_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">Local - Google Earth KML file<p class="tooltip">{$locale.google_earth.tooltip}</p>
		<div class="message">
		{if $results->google_earth}
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.google_earth.correct}
		{else}{if $locale.google_earth.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}{$locale.google_earth.problem}
		{/if}
		</div></td>
	</tr>
{/if}
{if $rel_author_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">rel="author" and rel="publisher" Tags<p class="tooltip">{$locale.rel_author.tooltip}</p>
		<div class="message">
		{if $results->rel_author}
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.rel_author.correct}
		{else}{if $locale.rel_author.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}{$locale.rel_author.problem}
		{/if}<br><br>
		{foreach from=$results->rel_author item=atext}
			{if $atext.rel}rel=<em>{$atext.rel}</em>{/if}&nbsp;&nbsp; 
			<a href="{$atext.url}" target="_blank">{if $atext.text}{$atext.text}{else}link tag{/if}</a><br>
		{/foreach}
		</div></td>
	</tr>
{/if}
{if $canonical_tag_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">rel="canonical" Tag<p class="tooltip">{$locale.canonical_tag.tooltip}</p>
		<div class="message">
		{if $results->canonical_tag}
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.canonical_tag.correct}
		{else}{if $locale.canonical_tag.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}{$locale.canonical_tag.problem}
		{/if}<br />
		{foreach from=$results->canonical_tag item=atext}
			<a href="{$atext.url}" target="_blank">{$atext.url}</a><br />
		{/foreach}
		</div></td>
	</tr>
{/if}
{if $canonical_url_enable}	
		<tr class="{cycle name=trbg}">
			<td colspan="2" class="subject"> Canonical www{if !$pdf}<p class="tooltip">{$locale.canonical_url.tooltip}</p>{/if}
			<div class="message">
				{if $results->canonical_url == true}
					<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.canonical_url.correct}
				{else}
				{if $locale.canonical_url.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}{$locale.canonical_url.problem}
				{/if}
			</div></td>
		</tr>
{/if}
{if $nested_tables_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject"> Nested Tables{if !$pdf}<p class="tooltip">{$locale.nested_tables.tooltip}</p>{/if}
		<div class="message">
			{if !$results->nested_tables}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.nested_tables.correct}
			{else}
				{if $locale.nested_tables.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}{$locale.nested_tables.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $inline_styles_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject"> Inline Styles{if !$pdf}<p class="tooltip">{$locale.inline_styles.tooltip}</p>{/if}
		<div class="message">
			{if $results->inline_styles eq false}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.inline_styles.correct}
			{else}
				{if $locale.inline_styles.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}{$locale.inline_styles.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $inline_script_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject"> Inline Javascript{if !$pdf}<p class="tooltip">{$locale.inline_script.tooltip}</p>{/if}
		<div class="message">
			{if $results->inline_script == false}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.inline_script.correct}
			{else}
				{if $locale.inline_script.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}{$locale.inline_script.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $favicon_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject"> Favicon{if !$pdf}<p class="tooltip">{$locale.favicon.tooltip}</p>{/if}
		<div class="message">
			{if $results->favicon}
				<img src="{$results->favicon}" alt="Favicon" class="icon" />{$locale.favicon.correct}
			{else}
				{if $locale.favicon.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}{$locale.favicon.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $favicon_linked_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject"> Favicon Method{if !$pdf}<p class="tooltip">{$locale.favicon_linked.tooltip}</p>{/if}
		<div class="message">
			{if $results->favicon_linked}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.favicon_linked.correct}
			{else}
				<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />{$locale.favicon_linked.problem}
			{/if}
		</div></td>
	</tr>
{/if}
</table>
{/if}
{if $alt_attributes_enable}
<h4> Image attributes</h4>
<table id="alt_attributes">
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">ALT Tags for Images<p class="tooltip">{$locale.alt_attributes.tooltip}</p>
		<div class="message">
{if !$results->alt_attributes}
	<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />{$locale.alt_attributes.problem}
{else}
<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
	{$locale.alt_attributes.correct}
	{foreach from=$results->alt_attributes item=image}
		<ul><li>{$image}</li></ul>
	{/foreach}
{/if}
</div></td>
</table>
{/if}
{if $anchor_text_enable || $internal_link_enable || $external_link_enable}
<h4> Links</h4>
<table id="anchor_text">
{if $anchor_text_enable}
	<tr class="{cycle name=trbg}">
	<td colspan="2" class="subject">Anchor Text<p class="tooltip">{$locale.anchor_text.tooltip}</p>
	<div class="message">
{if !$results->anchor_text}
	<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />{$locale.anchor_text.problem}
{else}<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
	{$locale.anchor_text.correct}<br><br>
	{foreach from=$results->anchor_text item=atext}
		{if $atext.rel}<em>{$atext.rel}</em>{/if}
		<a href="{$atext.url}">{$atext.text}</a><br>
	{/foreach}
{/if}
</div></td>
</tr>
{/if}
{if $internal_link_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">Internal Links<p class="tooltip">{$locale.internal_link.tooltip}</p>
		<div class="message">
		{if $results->internal_link_count < $locale.internal_link.max} 
			<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
			<strong>Internal Links: {$results->internal_link_count}</strong><br/>
			{$locale.internal_link.correct}
		{else}
			{if $locale.internal_link.important}
				<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			{else}
				<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}
			<strong>Internal Links: {$results->internal_link_count}</strong><br/>
			{$locale.internal_link.problem}
		{/if}
		</div></td>
	</tr>
{/if}
{if $external_link_enable}
	<tr class="{cycle name=trbg}">
		<td colspan="2" class="subject">External Links<p class="tooltip">{$locale.external_link.tooltip}</p>
		<div class="message">
				{if $results->external_link_count < $locale.external_link.max} 
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" /> <strong>External Links: {$results->external_link_count}</strong><br/>
				{$locale.external_link.correct}
				{else}
				{if $locale.external_link.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				<strong>External Links: {$results->external_link_count}</strong><br/>{$locale.external_link.problem}{/if}
				</div></td>
	</tr>
{/if}		
</table>
{/if}
{if $total_page_size_enable || $html_size_enable || $gzip_enable || $compression_ratio_enable || $gzip_size_enable || $xcache_enable}
<h4>Compression</h4>
<table id="compression">

{if $total_page_size_enable}
	<tr id="total_size" class="{cycle name=trbg}">
		<td colspan="2" class="subject">Total Page Size<br/><p class="tooltip">{$locale.total_page_size.tooltip}</p>
		<div class="message">
			{if $results->total_page_size < $locale.total_page_size.max}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
				{$results->humanize($results->total_page_size)} - {$locale.total_page_size.correct}
			{else}
			
				{if $locale.total_page_size.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				{$results->humanize($results->total_page_size)} - {$locale.total_page_size.problem}	
			{/if}
		</div></td>
	</tr>
{/if}
{if $html_size_enable}
	<tr id="html_size" class="{cycle name=trbg}">
		<td colspan="2" class="subject">HTML Size (uncompressed)<br/><p class="tooltip">{$locale.html_size.tooltip}</p>
		<div class="message">
			{if $results->html_size < $locale.html_size.max}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
				{$results->humanize($results->html_size)} - {$locale.html_size.correct}
			{else}
			
				{if $locale.html_size.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
			
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				{$results->humanize($results->html_size)} - {$locale.html_size.problem}	
			{/if}
		</div></td>
	</tr>
{/if}
{if $gzip_enable}
	<tr id="gzip" class="{cycle name=trbg}">
		<td colspan="2" class="subject">HTML Compression Status<br/><p class="tooltip">{$locale.gzip.tooltip}</p>
		<div class="message">
			{if $results->gzip}<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />{$locale.gzip.correct}
			{else}
			{if $locale.gzip.important}
			<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />{else}
			<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
			{/if}{$locale.gzip.problem}
			{/if}
		</div></td>
	</tr>
{/if}
{if $compression_ratio_enable}
		<tr id="compression_ratio" class="{cycle name=trbg}">
			<td colspan="2" class="subject">Compression Ratio<p class="tooltip">{$locale.compression_ratio.tooltip}</p>
			<div class="message">

				{if $results->gzip}
					{if $results->compression_ratio > $locale.compression_ratio.max}
						<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" /> {$results->compression_ratio}% - {$locale.compression_ratio.correct}
					{else}
				
					{if $locale.compression_ratio.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
					{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
					{/if}
						{$results->compression_ratio}% -
						{$locale.compression_ratio.problem}
					{/if}	
				{else}
					{if $locale.compression_ratio.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
					{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
					{/if}
						{$results->compression_ratio}% -
						{$locale.compression_ratio.problem}
				{/if}
			 
			</div></td>
		</tr>
{/if}
{if $gzip_size_enable}	
	{if $results->gzip}
		<tr id="gzip_size" class="{cycle name=trbg}">
			<td colspan="2" class="subject">HTML Size (compressed)<p class="tooltip">{$locale.gzip_size.tooltip}</p>
			<div class="message">{$results->humanize($results->gzip)} - {$locale.gzip_size.correct}
			</div></td>
		</tr>
	
	{elseif $results->predictive_gzip}
		<tr id="gzip_size" class="{cycle name=trbg}">
			<td colspan="2" class="subject">HTML Size (if compressed)<p class="tooltip">{$locale.gzip_size.tooltip}</p>
			<div class="message">
				{if $locale.predictive_gzip.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />	{$results->humanize($results->predictive_gzip)} - {$locale.gzip_size.problem}
				{/if}
			</div></td>
		</tr>
	{/if}
{/if}
{if $xcache_enable}
	<tr id="xcache" class="{cycle name=trbg}">
		<td colspan="2" class="subject">x-cache Header<p class="tooltip">{$locale.xcache.tooltip}</p>
		<div class="message">
			{if $results->xcache}
				<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
				{$locale.xcache.correct}
			{else}
			
				{if $locale.xcache.important}<img class="icon critical" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_critical}" />
				{else}<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
				{/if}
				
				{$locale.xcache.problem}
			{/if}
		</div></td>
	</tr>
{/if}
</table>
{/if}
{if $total_page_size_enable}
<h4>Total Page Size: {$results->humanize($results->total_page_size)}</h4>
{/if}
{if $total_page_size_enable}
<h4>Page Objects</h4>
<table id="page_objects">
	<thead>
		<tr class="{cycle name=trbg}">
			<td>Size</td>
			<td>Type</td>
			<td>URL</td>
		</tr>
	</thead>
	<tbody>
		{foreach from=$results->page_objects item=page_object}
			{if $page_object->size(true) != "0 Bytes"}
			<tr class="{cycle name=trbg}">
				<td>{$page_object->size(true)}</td>
				<td>{$page_object->type()}</td>
				<td><a href="{$page_object->url}">{$page_object->url|truncate:63:'...'}</a></td>
			</tr>
			{/if}
		{/foreach}
	</tbody>
</table>
{/if}
{if $showungrouped == 'ON'}
<div id="review">
	{if !empty($results->ugly)}<h4 id="critical">{$heading_critical}</h4>{/if}
	<table>
		{foreach from=$results->ugly item=critical }
			<tr class="{cycle name=trbg}">
				<td colspan="2" class="subject">{$critical}<br><p class="tooltip">{$locale.$critical.tooltip}</p>
				<div class="message">
					<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/stop.png" alt="{$heading_problem}" />
						{if $critical == 'compression_ratio' && $compression_ratio_enable}{$results->compression_ratio}% -{/if}
						{if $critical == 'html_size' && $html_size_enable}{$results->humanize($results->html_size)} - {/if}
						{if $critical == 'total_page_size' && $total_page_size_enable}{$results->humanize($results->total_page_size)}{/if}
						{if $critical == 'internal_link' && $internal_link_enable}<em>{$results->internal_link_count} Internal Links<br/> </em>{/if}
						{if $critical == 'external_link' && $external_link_enable}<em>{$results->external_link_count} External Links<br/> </em>{/if}
					
					<!-- TODO -->
					{$locale.$critical.problem}
					<em>
					{foreach from=$results->meta item=meta}
						{if $meta->getAttribute('name') == $critical}
							{$meta->getAttribute('content')}
						{/if}
					{/foreach}
					<!-- END TODO -->
						{if $critical == 'title' && $title_enable}{$results->title}{/if}
						
						
						{if $critical == 'internal_link' && $internal_link_enable}<br>	
							{foreach from=$results->internal_links item=atext}
								{if $atext.rel}<em>{$atext.rel}</em>{/if}
								<a href="{$atext.url}">{$atext.text}</a><br>
							{/foreach}
						{/if}
						{if $critical == 'external_link' && $external_link_enable}<br>
							{foreach from=$results->external_links item=atext}
								{if $atext.rel}<em>{$atext.rel}</em>{/if}
								<a href="{$atext.url}">{$atext.text}</a><br>
							{/foreach}
						{/if}
						</em>
				</div></td>
			</tr>
		{/foreach}
	</table>
	{if !empty($results->bad)}<h4 id="problems">{$heading_problem}</h4>{/if}
	<table>
		{foreach from=$results->bad item=bad }
			<tr class="{cycle name=trbg}">
				<td colspan="2" class="subject">{$bad}<p class="tooltip">{$locale.$bad.tooltip}</p>
				<div class="message">
					<img class="icon problem" src="{$this_theme}/images/icons/famfamfam/silk/exclamation.png" alt="{$heading_problem}" />
						{if $bad == 'compression_ratio' && $compression_ratio_enable}{$results->compression_ratio}% -{/if}
						{if $bad == 'html_size' && $html_size_enable}{$results->humanize($results->html_size)} - {/if}
						{if $bad == 'total_page_size' && $total_page_size_enable}{$results->humanize($results->total_page_size)}{/if}
						{if $bad == 'internal_link' && $internal_link_enable}<em>{$results->internal_link_count} Internal Links<br/> </em>{/if}
						{if $bad == 'external_link' && $external_link_enable}<em>{$results->external_link_count} External Links<br/> </em>{/if}
				
					{$locale.$bad.problem}
					<em>
					{foreach from=$results->meta item=meta}
						{if $meta->getAttribute('name') == $bad}
							{$meta->getAttribute('content')}
						{/if}
						{/foreach}
							{if $bad == 'title' && $title_enable}{$results->title}{/if}
							
					
							{if $bad == 'internal_link' && $internal_link_enable}<br>	
								{foreach from=$results->internal_links item=atext}
									{if $atext.rel}<em>{$atext.rel}</em>{/if}
									<a href="{$atext.url}">{$atext.text}</a><br>
								{/foreach}
							{/if}
							{if $bad == 'external_link' && $external_link_enable}<br>
								{foreach from=$results->external_links item=atext}
									{if $atext.rel}<em>{$atext.rel}</em>{/if}
									<a href="{$atext.url}">{$atext.text}</a><br>
								{/foreach}
							{/if}
							</em>
				</div></td>
			</tr>
		{/foreach}
	</table>
	{if !empty($results->good)}<h4 id="correct">{$heading_correct}</h4>{/if}
	<table>
		{foreach from=$results->good item=correct }
			<tr class="{cycle name=trbg}">
				<td colspan="2" class="subject">{$correct}<p class="tooltip">{$locale.$correct.tooltip}</p>
				<div class="message">
					<img class="icon correct" src="{$this_theme}/images/icons/famfamfam/silk/accept.png" alt="{$heading_correct}" />
					{if $correct == 'compression_ratio' && $compression_ratio_enable}{$results->compression_ratio}% -{/if}
					{if $correct == 'html_size' && $html_size_enable}{$results->humanize($results->html_size)} - {/if}
					{if $correct == 'total_page_size' && $total_page_size_enable}{$results->humanize($results->total_page_size)}{/if}
					{if $correct == 'favicon' && $favicon_enable}<img src="{$results->favicon}" alt="Favicon" class="icon" /> - {/if}
					{if $correct == 'internal_link' && $internal_link_enable}<em>{$results->internal_link_count} Internal Links<br/> </em>{/if}
					{if $correct == 'external_link' && $external_link_enable}<em>{$results->external_link_count} External Links<br/> </em>{/if}
					
					{$locale.$correct.correct} <br><em>
					{foreach from=$results->meta item=meta}
						{if $meta->getAttribute('name') == $correct}
							{$meta->getAttribute('content')}
						{/if}
					{/foreach}
					{if $correct == 'title' && $title_enable}{$results->title}{/if}
					{if $correct == 'h1_status' && $h1_status_enable}{foreach from=$results->h1 item=h1}
					{$h1->textContent}<br/>
					{/foreach}{/if}
					{if $correct == 'h2_status' && $h2_status_enable}{foreach from=$results->h2 item=h2}
					{$h2->textContent}<br/>
					{/foreach}{/if}
					{if $correct == 'alt_attributes' && $alt_attributes_enable}
					{foreach from=$results->alt_attributes item=image}
						<ul><li>{$image}</li></ul>
					{/foreach}{/if}
					
					{if $correct == 'internal_link' && $internal_link_enable}	
						{foreach from=$results->internal_links item=atext}
							{if $atext.rel}<em>{$atext.rel}</em>{/if}
							<a href="{$atext.url}">{$atext.text}</a><br>
						{/foreach}
					{/if}
					{if $correct == 'external_link' && $external_link_enable}
						{foreach from=$results->external_links item=atext}
							{if $atext.rel}<em>{$atext.rel}</em>{/if}
							<a href="{$atext.url}">{$atext.text}</a><br>
						{/foreach}
					{/if}
					</em>
				</div></td>
			</tr>
		{/foreach}
	</table>
	{/if}
	{$bottom_message}
</div>