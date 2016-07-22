/**
 * Tailor.Collections.Library
 *
 * The library collection.
 *
 * @augments Tailor.Collections.Searchable
 */
var $ = Backbone.$,
	SearchableCollection = require( './searchable' ),
	LibraryCollection;

LibraryCollection= SearchableCollection.extend( {

    /**
     * Returns the appropriate model based on the given tag.
     *
     * @since 1.0.0
     *
     * @param attrs
     * @param options
     * @returns {*|exports|module.exports}
     */
    model : function( attrs, options ) {
        var Model = window.Tailor.Models.lookup( attrs.tag, attrs.type );
        return new Model( attrs, options );
    },

	comparator : 'label',

	/**
	 * Returns the attributes of a model to use in a search.
	 *
	 * @since 1.0.0
	 *
	 * @param model
	 * @returns {string}
	 */
	getHaystack : function( model ) {
		return [
			model.get( 'label' ),
			model.get( 'type' ),
			model.get( 'description' ),
			model.get( 'badge' ),
			model.get( 'tag' )
		].join( ' ' );
	}

} );

module.exports = LibraryCollection;