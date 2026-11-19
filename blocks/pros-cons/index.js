(function (blocks, element, blockEditor, components) {

    const { createElement: el } = element;
    const { RichText } = blockEditor;
    const { Button } = components;

    blocks.registerBlockType('rswpt/pros-cons', {

        edit: function (props) {

            const { attributes, setAttributes } = props;
            const { prosTitle, consTitle, pros, cons } = attributes;

            // update list item
            const updateItem = (list, index, value) => {
                const newList = [...list];
                newList[index] = value;
                return newList;
            };

            // add item
            const addItem = (list, key) => {
                setAttributes({ [key]: [...list, ''] });
            };

            // remove item
            const removeItem = (list, key, index) => {
                const newList = list.filter((_, i) => i !== index);
                setAttributes({ [key]: newList });
            };

            return el('div', { className: 'rswp-proscons grid grid-cols-2 gap-4' },

                // ===== PROS =====
                el('div', { className: 'rswp-prosconsbox bg-green-50' },

                    el(RichText, {
                        tagName: 'h3',
                        value: prosTitle,
                        placeholder: 'Pros Title...',
                        onChange: (val) => setAttributes({ prosTitle: val })
                    }),

                    pros.map((item, index) =>
                        el('ul', { key: index },

                            el(RichText, {
                                tagName: 'li',
                                value: item,
                                placeholder: 'Add pros...',
                                onChange: (val) => setAttributes({
                                    pros: updateItem(pros, index, val)
                                })
                            }),

                            el(Button, {
                                isDestructive: true,
                                onClick: () => removeItem(pros, 'pros', index)
                            }, 'Remove')
                        )
                    ),

                    el(Button, {
                        isPrimary: true,
                        onClick: () => addItem(pros, 'pros')
                    }, 'Add Pros')
                ),

                // ===== CONS =====
                el('div', { className: 'rswp-prosconsbox bg-red-50' },

                    el(RichText, {
                        tagName: 'h3',
                        value: consTitle,
                        placeholder: 'Cons Title...',
                        onChange: (val) => setAttributes({ consTitle: val })
                    }),

                    cons.map((item, index) =>
                        el('ul', { key: index },

                            el(RichText, {
                                tagName: 'li',
                                value: item,
                                placeholder: 'Add cons...',
                                onChange: (val) => setAttributes({
                                    cons: updateItem(cons, index, val)
                                })
                            }),

                            el(Button, {
                                isDestructive: true,
                                onClick: () => removeItem(cons, 'cons', index)
                            }, 'Remove')
                        )
                    ),

                    el(Button, {
                        isPrimary: true,
                        onClick: () => addItem(cons, 'cons')
                    }, 'Add Cons')
                )

            );
        },

        save: function () {
            return null;
        }

    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components);