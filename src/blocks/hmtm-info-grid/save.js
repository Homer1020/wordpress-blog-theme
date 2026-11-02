import { useBlockProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { items } = attributes;
    const blockProps = useBlockProps.save({
        className: 'row'
    });

    return (
        <div {...blockProps}>
            {items.map((item, index) => (
                <div 
                    key={index} 
                    className={`col-lg-${item.columns}`}
                >
                    {item.title && <h4>{item.title}</h4>}
                    {item.description && <p>{item.description}</p>}
                </div>
            ))}
        </div>
    );
}