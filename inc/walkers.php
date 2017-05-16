<?php

class Walker_Sitemap extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @param	string $output Passed by reference. Used to append additional content.
	 * @param	object $item	 Menu item data object.
	 * @param	int $depth		 Depth of menu item. May be used for padding.
	 * @param	array $args		Additional strings.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		$output		 .= '<li class="sitemap__item">';
		$attributes	= '';

		! empty ( $item->url )
			and $attributes .= ' href="' . esc_attr( $item->url ) .'"';

		$attributes .= ' class="sitemap__link pri-footer__link"';

		$attributes	= trim( $attributes );
		$title			 = apply_filters( 'the_title', $item->title, $item->ID );
		$item_output = $args->before;
		$item_output .= "<a $attributes>";
		$item_output .= $args->link_before . $title;
		$item_output .= "</a>";
		$item_output .= $args->link_after . $args->after;

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el',
			$item_output,
			$item,
			$depth,
			$args
		);
	}

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() )
	{
		$output .= '<ul class="sitemap__sub-menu">';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() )
	{
		$output .= '</ul>';
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() )
	{
		$output .= '</li>';
	}
}
