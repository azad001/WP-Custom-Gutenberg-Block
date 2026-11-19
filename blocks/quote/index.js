(function (blocks, element, blockEditor) {

    const { createElement: el } = element;
    const { RichText } = blockEditor;

    blocks.registerBlockType('rswpt/quote', {

        edit: function (props) {

            const { attributes, setAttributes } = props;

            return el('div',
                {
                    className: 'wp-block-rswpt-quote'
                },

                el(RichText, {
                    tagName: 'p',
                    value: attributes.quote,
                    placeholder: 'Quote...',
                    onChange: (val) => setAttributes({ quote: val })
                }),

                el(RichText, {
                    tagName: 'span',
                    value: attributes.author,
                    placeholder: 'Author...',
                    onChange: (val) => setAttributes({ author: val })
                })
            );
        },

        save: function () {
            return null;
        }

    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor);