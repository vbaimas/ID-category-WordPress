<?php
add_filter( 'manage_edit-category_columns', 'wpse_77532_cat_edit_columns' );
add_filter( 'manage_category_custom_column', 'wpse_77532_cat_custom_columns', 10, 3 );
add_action( 'admin_head-edit-tags.php', 'wpse_77532_column_width' );

/**
 * Register the ID column
 */
function wpse_77532_cat_edit_columns( $columns )
{
    $in = array( "cat_id" => "ID" );
    $columns = wpse_77532_array_push_after( $columns, $in, 0 );
    return $columns;
}   
/**
 * Print the ID column
 */
function wpse_77532_cat_custom_columns( $value, $name, $cat_id )
{
    if( 'cat_id' == $name ) 
       echo $cat_id;
}
/*** CSS to reduce the column width*/
function wpse_77532_column_width()
{
 // Tags page, exit earlier
    if( 'category' != $_GET['taxonomy'] )
        return;
    echo '<style>.column-cat_id {width:3%}</style>';
}
/*** Insert an element at the beggining of the array*/
function wpse_77532_array_push_after( $src, $in, $pos )
{
 if ( is_int( $pos ) )
        $R = array_merge( array_slice( $src, 0, $pos + 1 ), $in, array_slice( $src, $pos + 1 ) );
    else
    {
        foreach ( $src as $k => $v )
        {
            $R[$k] = $v;
            if ( $k == $pos )
                $R       = array_merge( $R, $in );
        }
    }
    return $R;
}
?>