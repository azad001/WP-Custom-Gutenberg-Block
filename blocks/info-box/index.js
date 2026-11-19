(function (blocks, element, blockEditor, components) {

    const { createElement: el } = element;
    const { RichText } = blockEditor;
    const { Button } = components;

    blocks.registerBlockType('rswpt/info-box', {

        edit: function (props) {

            const { attributes, setAttributes } = props;
            const { title, items } = attributes;

            const updateItem = (value, index) => {
                const newItems = [...items];
                newItems[index] = value;
                setAttributes({ items: newItems });
            };

            const addItem = () => {
                setAttributes({ items: [...items, ''] });
            };

            const removeItem = (index) => {
                const newItems = items.filter((_, i) => i !== index);
                setAttributes({ items: newItems });
            };

            return el('div', { className: 'bg-blue-50 p-4 border border-blue-100 rounded-xl' },

                el(RichText, {
                    tagName: 'h3',
                    value: title,
                    placeholder: 'Info title...',
                    onChange: (val) => setAttributes({ title: val })
                }),

                items.map((item, index) =>
                    el('div', { key: index, style: { marginBottom: '10px' } },

                        el(RichText, {
                            tagName: 'p',
                            value: item,
                            placeholder: 'Info item...',
                            onChange: (val) => updateItem(val, index)
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
            return null; // dynamic block
        }

    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components);