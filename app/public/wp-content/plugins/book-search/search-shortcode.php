<?php
    function search_book_shortcode() {
        my_ajax_filter_search_scripts();
        ob_start();
        
        
            $publishers = get_terms('book_publisher', array(
                'order' => 'ASC'
            )) ;
            $authors = get_terms('book_author', array(
                'order' => 'ASC'
            ));
        ?>
        <div id="my-ajax-filter-search">
        <form action="" method="get" id="searchform" name="searchform">
            <div class="form-wrap">
                    <div>
                        <select name="book_author" class="author" id="book_author">
                            <option value="" selected>Author</option>
                                <?php
                                    foreach($authors as $author) {
                                ?>
                            <option value=<?php echo $author->slug; ?>>
                                <?php echo($author->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <select name="book_publisher" class="publisher" id="book_publisher">
                            <option value="" selected>Publisher</option>
                                <?php
                                    foreach($publishers as $publisher) {
                                ?>
                            <option value=<?php echo $publisher->slug; ?>>
                                <?php echo($publisher->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <select name="rating" id="rating" class="rating">
                            <option value="" selected>Rating</option>
                            <option value="1" <?php echo get_field('rating') == 1 ? 'selected' : null; ?>>1</option>
                            <option value="2" <?php echo get_field('rating') == 2 ? 'selected' : null; ?>>2</option>
                            <option value="3" <?php echo get_field('rating') == 3 ? 'selected' : null; ?>>3</option>
                            <option value="4" <?php echo get_field('rating') == 4 ? 'selected' : null; ?>>4</option>
                            <option value="5" <?php echo get_field('rating') == 5 ? 'selected' : null; ?>>5</option>
                        </select>
                    </div>
                    <div class="price-range">
                        <label class="price">Price: <span id="rangeValue">0</span></label>
                        <input type="range" name="price" id="price" value="<?php echo get_field('price'); ?>" min="0" max="500">
                    </div>
                    <div class="search-b">
                        <input type="text" alt="search" id="search" name="search" class="search" placeholder="Enter book name here">
                    </div>
                    <div class="btnsave">
                        <input type="submit" value="Search" class="btnsubmit" name="submit" id="submit">
                    </div>
                </div>
            </form>
            <ul id="ajax_filter_search_results"></ul>
        </div>
        
        
        <?php
        //}
        $obj_clean_search = ob_get_clean();
        return $obj_clean_search;
    }
    add_shortcode('search_book', 'search_book_shortcode');