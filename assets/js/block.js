(function (blocks, element, blockEditor) {

    const el = element.createElement;
    const RichText = blockEditor.RichText;

    blocks.registerBlockType('rswpt/quote', {

        title: 'RSWPT Block Quote',
        icon: 'format-quote',
        category: 'text',

        attributes: {
            quote: {
                type: 'string',
                source: 'html',
                selector: '.rswpt-quote-text',
            },
            author: {
                type: 'string',
                source: 'html',
                selector: '.rswpt-quote-author',
            }
        },

        edit: function (props) {

            return el('blockquote',
                {
                    className: 'border-l-4 border-brand-500 bg-gray-50 p-6 md:p-8 my-8 rounded-r-lg italic text-xl text-gray-800 shadow-sm relative'
                },

                // icon
                el('i', {
                    className: 'fas fa-quote-left absolute top-4 left-4 text-brand-200 text-3xl opacity-50'
                }),

                // quote text
                el(RichText, {
                    tagName: 'p',
                    className: 'rswpt-quote-text',
                    value: props.attributes.quote,
                    placeholder: 'Write quote...',
                    onChange: function (value) {
                        props.setAttributes({ quote: value });
                    }
                }),

                // author
                el(RichText, {
                    tagName: 'span',
                    className: 'rswpt-quote-author block text-sm font-bold font-sans text-brand-600 mt-4 not-italic',
                    value: props.attributes.author,
                    placeholder: 'Author name...',
                    onChange: function (value) {
                        props.setAttributes({ author: value });
                    }
                })
            );
        },

        save: function (props) {

            return el('blockquote',
                {
                    className: 'border-l-4 border-brand-500 bg-gray-50 p-6 md:p-8 my-8 rounded-r-lg italic text-xl text-gray-800 shadow-sm relative'
                },

                el('i', {
                    className: 'fas fa-quote-left absolute top-4 left-4 text-brand-200 text-3xl opacity-50'
                }),

                el('p', { className: 'rswpt-quote-text' },
                    props.attributes.quote
                ),

                el('span', {
                    className: 'rswpt-quote-author block text-sm font-bold font-sans text-brand-600 mt-4 not-italic'
                },
                    '— ' + props.attributes.author
                )
            );
        }

    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor);