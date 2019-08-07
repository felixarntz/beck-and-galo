/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	// Custom 'post_instance' partial type.
	if ( wp.customize.selectiveRefresh ) {
		function findParent( element, selector ) {
			while ( element && element !== document ) {
				element = element.parentElement;

				if ( element.matches( selector ) ) {
					return element;
				}
			}

			return undefined;
		}

		wp.customize.selectiveRefresh.partialConstructor.post_instance = wp.customize.selectiveRefresh.Partial.extend( {
			placements: function() { // eslint-disable-line object-shorthand
				const partial = this;
				let selector;

				selector = partial.params.selector || '';
				if ( selector ) {
					selector += ', ';
				}
				selector += '[data-customize-partial-id="' + partial.id + '"]';

				return Array.from( document.querySelectorAll( selector ) ).map( ( element ) => {
					return new wp.customize.selectiveRefresh.Placement( {
						partial,
						container: element,
						context: {
							post_id: parseInt( findParent( element, 'article.hentry' ).id.replace( 'post-', '' ), 10 ),
						},
					} );
				} );
			},
		} );
	}
}( jQuery ) );
