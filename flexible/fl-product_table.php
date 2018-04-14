<?php
global $cat_id;

// Table Wrap
echo '<div class="table-wrap minimized">';

// Table Itself
$show_specs_row = get_sub_field('show_specs_row');
$table_cols = get_sub_field('table_cols');
$table_rows = get_sub_field('table_rows');

echo '<div class="table-scroll"><table class="specs-table zebra">';

  // Table Headings
  echo '<thead><tr>';

    $col = 0;
    while( $col++ < $table_cols ){
      echo '<th>' . get_sub_field('th_' . $col) . '</th>';
    }

    // Specs
    if( $show_specs_row ){
      echo '<th>Specs</th>';
    }

  echo '</tr></thead>';

  // Table Rows
  echo '<tbody>';

  $odd = true;
  foreach( $table_rows as $row ){

    $odd = !$odd;

    echo '<tr class="' . ($odd ? 'odd' : 'even') . '">';

      // Regular cells
      $col = 0;
      while( $col++ < $table_cols ){
        echo '<td>' . $row['col_' . $col] . '</td>';
      }

      // Specs
      if( $show_specs_row ){
        $specs = $row['specs'];
        echo '<td>' . ( $specs ? '<a class="button small-button specs-button" href="' . $specs . '" target="_blank">Download Specs</a>' : '&nbsp;' ) . '</td>';
      }

    echo '</tr>';

  }

  echo '</tbody>';


echo '</table></div>';

// Expand Button
echo '<a class="expand-table table-toggle" href="javascript:void(0);"><div class="mask"></div><div class="toggle-button' . ( $cat_id ? ' cat-col-' . $cat_id . ' cc-bg' : '' ) . '">' . svgi('arrow-down') . '<span class="text">Expand Table</span></div></a>';

// Minimize Button
echo '<a class="minimize-table table-toggle" href="javascript:void(0);"><div class="toggle-button' . ( $cat_id ? ' cat-col-' . $cat_id . ' cc-bg' : '' ) . '">' . svgi('arrow-up') . '<span class="text">Minimize Table</span></div></a>';

// close table wrap
echo '</div>';
?>
