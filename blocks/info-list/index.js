(function (blocks, element, blockEditor, components) {

    const { createElement: el } = element;
    const { RichText } = blockEditor;
    const { Button } = components;

    blocks.registerBlockType('rswpt/info-list', {

        edit: function (props) {

            const { attributes, setAttributes } = props;
            const { items } = attributes;

            const updateItem = (key, value, index) => {
                const newItems = [...items];
                newItems[index][key] = value;
                setAttributes({ items: newItems });
            };

            const addItem = () => {
                setAttributes({
                    items: [...items, { label: '', text: '' }]
                });
            };

            const removeItem = (index) => {
                const newItems = items.filter((_, i) => i !== index);
                setAttributes({ items: newItems });
            };

            return el('ul', { className: 'rswp-bloclist' },

                items.map((item, index) =>
                    el('li', { key: index },

                        el(RichText, {
                            tagName: 'strong',
                            value: item.label,
                            placeholder: 'Label (Cue)',
                            onChange: (val) => updateItem('label', val, index)
                        }),

                        el(RichText, {
                            tagName: 'span',
                            value: item.text,
                            placeholder: 'Description...',
                            onChange: (val) => updateItem('text', val, index)
                        }),

                        el(Button, {
                            isDestructive: true,
                            onClick: () => removeItem(index)
                        }, 'Remove')
                    )
                ),

                el(Button, {
                    isPrimary: true,
                    onClick: addItem
                }, 'Add Item')
            );
        },

        save: function () {
            return null; // dynamic
        }

    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components);