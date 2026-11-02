import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { Button, TextControl, TextareaControl, RangeControl, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { items } = attributes;
    const blockProps = useBlockProps({ className: 'grid-repeater-editor' });

    const addItem = () => {
        const newItems = [...items, { title: '', description: '', columns: 4 }];
        setAttributes({ items: newItems });
    };

    const updateItem = (index, key, value) => {
        const newItems = [...items];
        newItems[index][key] = value;
        setAttributes({ items: newItems });
    };

    const removeItem = (index) => {
        const newItems = items.filter((_, i) => i !== index);
        setAttributes({ items: newItems });
    };

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title={__('Opciones del Repetidor', 'mi-tema')}>
                    <p>{__('Añade y configura los elementos de la cuadrícula.', 'mi-tema')}</p>
                    <Button variant="primary" onClick={addItem} style={{ width: '100%', justifyContent: 'center' }}>
                        {__('Agregar Elemento', 'mi-tema')}
                    </Button>
                </PanelBody>
            </InspectorControls>

            <div className="repeater-items-container" style={{ display: 'grid', gridTemplateColumns: 'repeat(12, 1fr)', gap: '1rem' }}>
                {items.length === 0 ? (
                    <div style={{ gridColumn: 'span 12', textAlign: 'center', padding: '2rem', background: '#f0f0f0', borderRadius: '4px' }}>
                        <p>{__('No hay elementos. Añade uno desde la barra lateral.', 'mi-tema')}</p>
                        <Button variant="secondary" onClick={addItem}>
                            {__('Agregar primer elemento', 'mi-tema')}
                        </Button>
                    </div>
                ) : (
                    items.map((item, index) => (
                        <div 
                            key={index} 
                            style={{ 
                                gridColumn: `span ${item.columns}`, 
                                background: '#fff', 
                                border: '1px solid #ccc', 
                                padding: '1rem', 
                                borderRadius: '4px',
                                position: 'relative'
                            }}
                        >
                            <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.5rem' }}>
                                <strong>#{index + 1} (Col: {item.columns}/12)</strong>
                                <Button isDestructive variant="link" onClick={() => removeItem(index)}>
                                    {__('Eliminar', 'mi-tema')}
                                </Button>
                            </div>

                            <TextControl
                                label={__('Título', 'mi-tema')}
                                value={item.title}
                                onChange={(value) => updateItem(index, 'title', value)}
                                placeholder={__('Título del elemento', 'mi-tema')}
                            />

                            <TextareaControl
                                label={__('Descripción', 'mi-tema')}
                                value={item.description}
                                onChange={(value) => updateItem(index, 'description', value)}
                                placeholder={__('Descripción corta...', 'mi-tema')}
                            />

                            <RangeControl
                                label={__('Ancho en Columnas', 'mi-tema')}
                                value={item.columns}
                                onChange={(value) => updateItem(index, 'columns', value)}
                                min={1}
                                max={12}
                            />
                        </div>
                    ))
                )}
            </div>
        </div>
    );
}