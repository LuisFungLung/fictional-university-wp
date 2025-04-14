import { ToolbarGroup, ToolbarButton } from "@wordpress/components"
import { RichText, BlockControls } from "@wordpress/block-editor"
import { registerBlockType } from "@wordpress/blocks"

/* Old way to call registerBlockType */
// wp.blocks.registerBlockType("ourblocktheme/genericheading",{
//     title: "Generic Heading",
//     edit: EditComponent,
//     save: saveComponent,
// })

registerBlockType("ourblocktheme/genericheading",{
    title: "Generic Heading",
    attributes: {
        text: {type: "string"},
        size: {type: "string", default: "large"}
    },
    edit: EditComponent,
    save: saveComponent,
})

function EditComponent(props) {   

    function handleTextChange(x) {
        props.setAttributes({text: x})
    }

    return (
        <>
            <BlockControls></BlockControls>
                <ToolbarGroup>
                    <ToolbarButton isPressed={props.attributes.size === "large"} onClick={() => props.setAttributes({size:"large"})} >Large</ToolbarButton>
                    <ToolbarButton isPressed={props.attributes.size === "medium"} onClick={() => props.setAttributes({size:"medium"})} >Medium</ToolbarButton>
                    <ToolbarButton isPressed={props.attributes.size === "small"} onClick={() => props.setAttributes({size:"small"})} >Small</ToolbarButton>
                </ToolbarGroup>
            <RichText allowedFormats={["core/bold", "core/italic"]} tagName="h1" className={`headline headline--${props.attributes.size}`} value={props.attributes.text} onChange={handleTextChange} />
        </>
    )
}

function saveComponent(props) {
    
    function createTagName() {
        switch(props.attributes.size) {
            case "large":
                return "h1"
            case "medium":
                return "h2"
            case "small":
                return "h3"
        }
    }

    return  <RichText.Content value={props.attributes.text} tagName={createTagName()} className={`headline headline--${props.attributes.size}`} />
    
      
}