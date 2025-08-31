<?
/*
 *Product ajax search code
 *[woo_search num="5" sku="on" description="on" price="on"]
 *https://redpishi.com/wordpress-tutorials/product-ajax-search-code/
 */
add_shortcode("woo_search", "woo_search_func");
function woo_search_func($atts)
{
    $atts = shortcode_atts(
        [
            "image" => "true",
            "check_stock" => "", // on
            "sku" => "", // off
            "description" => "", // off
            "price" => "", // off
            "num" => "5",
            "cat" => "on", // on
        ],
        $atts,
        "woo_search"
    );
    static $woo_search_first_call = 1;
    $image = $atts["image"];
    $stock = $atts["check_stock"];
    $sku = $atts["sku"];
    $description = $atts["description"];
    $price = $atts["price"];
    $num = $atts["num"];
    $cat = $atts["cat"];

    $woo_search_form =
        '<div class="woo_search_bar woo_bar_el">
    <form class="woo_search woo_bar_el" id="woo_search' .
        $woo_search_first_call .
        '" action="/" method="get" autocomplete="off">
		<span class="loading woo_bar_el" >
		<svg width="25px" height="25px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" class="hds-flight-icon--animation-loading woo_bar_el">
<g fill="#676767" fill-rule="evenodd" clip-rule="evenodd">
<path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"/>
<path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"/>
</g>
</svg>
		</span>
        <input type="search" name="s" placeholder="Search ..." id="keyword" class="input_search woo_bar_el" onkeyup="searchFetch(this)"><button id="mybtn" class="search' .
        $woo_search_first_call .
        ' woo_bar_el">
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg>
        </button>
        <input type="hidden" name="post_type" value="product">
        <input type="hidden" name="search_id" value="' .
        $woo_search_first_call .
        '">
        <input type="hidden" name="check_stock" value="' .
        $stock .
        '">
        <input type="hidden" name="sku" value="' .
        $sku .
        '">
        <input type="hidden" name="description" value="' .
        $description .
        '">
        <input type="hidden" name="price" value="' .
        $price .
        '">
        <input type="hidden" name="num" value="' .
        $num .
        '">
        <input type="hidden" name="cat" value="' .
        $cat .
        '">
    </form><div class="search_result woo_bar_el" id="datafetch" style="display: none;">
        <ul>
            <li>Please wait..</li>
        </ul>
    </div></div>';
    $java =
        '<script>
function searchFetch(e) {
const searchForm = e.parentElement;	
searchForm.querySelector(".loading").style.visibility = "visible";

var datafetch = e.parentElement.nextSibling
if (e.value.trim().length > 0) { datafetch.style.display = "block"; } else { datafetch.style.display = "none"; }

e.nextSibling.value = "Please wait..."
var formdata' .
        $woo_search_first_call .
        ' = new FormData(searchForm);
formdata' .
        $woo_search_first_call .
        '.append("image", "' .
        $image .
        '") 
formdata' .
        $woo_search_first_call .
        '.append("action", "woo_search") 
Ajaxwoo_search(formdata' .
        $woo_search_first_call .
        ',e) 

}
async function Ajaxwoo_search(formdata,e) {
  const url = "' .
        admin_url("admin-ajax.php") .
        '?action=woo_search";
  const response = await fetch(url, {
      method: "POST",
      body: formdata,
  });
  const data = await response.text();
if (data){	e.parentElement.nextSibling.innerHTML = data}else  {
e.parentElement.nextSibling.innerHTML = `<ul><a href="#" style="display: block; padding-inline-start: 14px;"><li>Sorry, nothing found</li></a></ul>`
}
e.parentElement.querySelector(".loading").style.visibility = "hidden";
}	
function goSearch(id){document.querySelector(id).click(); console.log(`clicked`) }

document.addEventListener("click", function(e) { if (document.activeElement.classList.contains("woo_bar_el") == false ) { [...document.querySelectorAll("div.search_result")].forEach(e => e.style.display = "none") } else {if  (e.target?.value.trim().length > 0) { e.target.parentElement.nextSibling.style.display = "block"}} })

</script>';
    $css = '<style>form.woo_search { display: flex; flex-wrap: nowrap; border: 1px solid #f0f0f0; border-radius: 10vh; padding: 3px 5px; background-color: white; box-shadow: 0px 6px 9px #00000017; }
form.woo_search button#mybtn { display: grid; padding: 4px; cursor: pointer; background: none; align-items: center;border: none; }
form.woo_search input#keyword {border: none;}
div#datafetch {
    background: white;
    z-index: 10;
    position: absolute;
    max-height: 425px;
    overflow: auto;
    box-shadow: 0px 15px 15px #00000036;
    right: 0;
    left: 0;
    top: 50px;
}
div.woo_search_bar {
    width: 600px!important;
    max-width: 90%!important;
    position: relative;
}

div.search_result ul a li {
    display: flex;
    margin: 0px;
    padding: 0px 0px 0px 0px;
    color: #3f3f3f;
    font-weight: bold;
    flex-direction: column;
    justify-content: space-evenly;
}
div.search_result li {
    margin-inline-start: 20px;
    list-style: none;
}
div.search_result ul {
    padding: 13px 0px 0px 0px!important;
    list-style: none;
    margin: auto;
}

div.search_result ul a {
    display: grid;
    grid-template-columns: 70px 1fr minmax(70px , min-content);
    margin-bottom: 10px;
    gap: 5px;
}
div.search_result ul a h5 {
    font-size: 1em;
    padding: 0;
    margin: 0;
    font-weight: bold;
}
div.search_result ul a p.des {
    font-weight: normal;
    font-size: 0.9em;
    color: #676767;
    padding: 0;
    margin: 0;
    line-height: 1.3em;
}
div.search_result ul a h5.sku {
    font-weight: normal;
    font-size: 0.85em;
    color: #676767;
    padding: 0!important;
    margin: 0!important;
}
div.search_result ul a span.title_r_1 {
    display: flex;
    flex-direction: row;
    gap: 9px;
}
div.search_result ul a:hover {
    background-color: #f3f3f3;
}
.woo_search input#keyword {
    outline: none;
    width: 100%;
    background-color: white;
}
span.loading {
    display: grid;
    align-items: center;
}
@-webkit-keyframes rotating {
    from{
        -webkit-transform: rotate(0deg);
    }
    to{
        -webkit-transform: rotate(360deg);
    }
}

.hds-flight-icon--animation-loading {
    -webkit-animation: rotating 1s linear infinite;
}
span.loading {
    visibility: hidden;
}
span.price p {
    padding: 0;
    margin: 0;
}
span.price {
    display: flex;
    margin-inline-end: 5px;
    align-items: center;
    color: #535353;
}
span.price .sale-price {
    justify-content: flex-start;
 
}
div#datafetch a {
    text-decoration: none;
}
ul.cat_ul.woo_bar_el {
    display: flex;
    flex-wrap: wrap;
    gap: 0px;
}
a.cat_a.woo_bar_el {
    display: block;
    color: #5a5a5a;
    padding: 4px 15px;
    border-radius: 10vh;
    border: 1px solid #5a5a5a;
}
a.cat_a.woo_bar_el:hover {
    background-color: #5a5a5a;
    color: white;
}

p.search_title {
    margin: 10px 0px 0px 8px;
    line-height: normal;
    color: #676767;
    font-size: 0.9em;
    font-weight: normal;
    padding: 0;
}
hr.search_title {
    background-color: #cccccc;
    margin: 2px 8px 0px 8px;
}
</style>';
    if ($woo_search_first_call == 1) {
        $woo_search_first_call++;
        return "{$woo_search_form}{$java}{$css}";
    } elseif ($woo_search_first_call > 1) {
        $woo_search_first_call++;
        return "{$woo_search_form}";
    }
}

add_action("wp_ajax_woo_search", "woo_search");
add_action("wp_ajax_nopriv_woo_search", "woo_search");
function woo_search()
{
    //sleep(1s);
    $search_id = esc_attr($_POST["search_id"]);
    $stock = "";
    $sku = esc_attr($_POST["sku"]);
    $description = esc_attr($_POST["description"]);
    $price = esc_attr($_POST["price"]);
    $num = esc_attr($_POST["num"]);
    $cat = "";
    $search_term = esc_attr($_POST["s"]);

    if ($sku == "off") {
        $sku = "style='display: none;'";
    }
    if ($description == "off") {
        $description = "style='display: none;'";
    }

    if ($cat == "on") {
        // Get categories

        $categories = get_terms([
            "taxonomy" => "product_cat",
            "name__like" => $search_term,
            "orderby" => "name",
            "order" => "ASC",
        ]);

        if (!empty($categories) && !is_wp_error($categories)) {
            echo '<p class="search_title">CATEGORIES</p> ';
            echo '<hr class="search_title">';
            echo '<ul class="cat_ul woo_bar_el">';

            foreach ($categories as $category) {
                $category_link = get_term_link(
                    $category->term_id,
                    "product_cat"
                );
                $product_count = $category->count;
                echo '<li class="cat_li woo_bar_el"><a class="cat_a woo_bar_el" href="' .
                    esc_url($category_link) .
                    '">' .
                    esc_html($category->name) .
                    " (" .
                    $product_count .
                    ")</a></li>";
            }
            echo "</ul>";
        }
    }

    $the_query = new WP_Query([
        "posts_per_page" => $num,
        "post_type" => "product",
        "s" => $search_term,
    ]);

    if (!$the_query->have_posts()) {
        $the_query = new WP_Query([
            "posts_per_page" => $num,
            "post_type" => "product",
            "meta_query" => [
                [
                    "key" => "_sku",
                    "value" => $search_term,
                    "compare" => "LIKE",
                ],
            ],
        ]);
    }

    $number_of_result = $the_query->found_posts;
    if ($number_of_result > 5) {
        $show_all =
            '<button class="show_all woo_bar_el" style="text-align: center; background: white; width: 100%; padding: 5px; color: #666464; cursor: pointer; font-size: 0.95em;border: none; "   onclick="goSearch(`button.search' .
            $search_id .
            '`)"  >SEE ALL PRODUCTS.. (' .
            $number_of_result .
            ")</button>";
    } else {
        $show_all = "";
    }

    if ($the_query->have_posts()):
        if ($cat == "on") {
            echo '<p class="search_title">PRODUCTS</p> ';
            echo '<hr class="search_title">';
        }

        echo '<ul class="woo_bar_el">';
        while ($the_query->have_posts()):

            $the_query->the_post();
            $product = wc_get_product();
            $current_price = $product->get_price_html();
            if ($current_price == "") {
                $current_price = "SOLD OUT";
                $sold_style =
                    "style='font-size: 0.75em; font-weight: bold; color: red; '";
            } else {
                $sold_style = "";
            }
            if ($current_price == "SOLD OUT" && $stock == "on") {
                $stock_hide = "style='display: none;'";
            } else {
                $stock_hide = "";
            }
            ?>
        
            <a href="<?php echo esc_url(
                post_permalink()
            ); ?>" class="woo_bar_el" <?= $stock_hide ?> >
<?php $image = wp_get_attachment_image_src(
    get_post_thumbnail_id(),
    "single-post-thumbnail"
); ?>                               
<?php if (
    $image[0] &&
    trim(esc_attr($_POST["image"])) == "true"
) { ?>  <img src="<?php the_post_thumbnail_url(
      "thumbnail"
  ); ?>" style="height: 60px;padding: 0px 5px;">
<li><span class="title_r_1"><h5><?php the_title(); ?></h5 class="product_name"><h5 class="sku" <?= $sku ?> >(SKU:  <?php echo $product->get_sku(); ?>) </h5></span><p class="des" <?= $description ?> > <?php echo wp_trim_words(
     $product->get_short_description(),
     15,
     "..."
 ); ?> </p> </li>	


<?php if ($price != "off") { ?> 
	<span class="price" <?= $sold_style ?> > <span> <?= $current_price ?> </span></span>
 <?php }} ?> 
</a>
        <?php
        endwhile;
        echo $show_all;
        echo "</ul>";
        wp_reset_postdata();
    endif;
    die();
}

add_action('woocommerce_before_shop_loop', 'insert_woo_search_shortcode', 5);

function insert_woo_search_shortcode() {
    if (is_shop()) {
        echo do_shortcode('[woo_search num="5" sku="on" description="off" price="off" cat="on"]');
    }
}
