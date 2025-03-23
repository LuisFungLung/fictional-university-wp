import "./index.scss"
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker} from "@wordpress/components"
import {InspectorControls, BlockControls, AlignmentToolbar, useBlockProps} from "@wordpress/block-editor"
import {ChromePicker} from "react-color"

(function() {
    let locked = false

    wp.data.subscribe( function(){
        const results = wp.data.select("core/block-editor").getBlocks().filter( function(block) {
            return block.name == "ourplugin/are-you-paying-attention" && block.attributes.correctAnswer == undefined
        } )

        if (results.length && !locked) {
            locked = true
            wp.data.dispatch("core/editor").lockPostSaving("noanswer")
        }

        if (!results.length && locked) {
            locked = false
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer")
        }

    } )
})()

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention",{
    title: "Are You Paying Attention?",
    icon: "smiley",
    category: "common",
    attributes: {
        /* Pass less info to the database */
        // skyColor: {type: "string", source: "text", selector: ".skyColor"},
        // grassColor: {type: "string", source: "text", selector: ".grassColor"}
        question: {type: "string"},
        answers: {type: "array", default: [""]},
        correctAnswer: {type: "number", default: undefined},
        bgColor: {type: "string", default: "#EBEBEB"},
        theAlignment: {type: "string", default: "left"}
    },
    description: "Give your audience a chance to prove their comprehension",
    example: {
        attributes: {
            question: "What is my name",
            answers: ['Meowsalot','Barksalot','Froggerson','Luis'],
            correctAnswer: 3,
            bgColor: "#CFE8F1",
            theAlignment: "center"
        }
    },
    edit: EditComponent,
    /* old Edit function */
    // edit: function(props) {
    //     // return wp.element.createElement("h3", null, "Hello, this is from the admin editor screen.")
    //     function updateSkyColor(event) {
    //         props.setAttributes({skyColor: event.target.value})
    //     }

    //     function updateGrassColor(event) {
    //         props.setAttributes({grassColor: event.target.value})
    //     }


    //     return (
    //         <div>
    //             <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor} />
    //             <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor} />
    //         </div>
    //     )
    // },    
    save: function(props) {
        /* Old way to edit a post */
        // return (
        //     <h6>Today the sky is absolutely <span className="skyColor">{props.attributes.skyColor}</span>  and the grass is <span className="grassColor">{props.attributes.grassColor}</span></h6>
          
        // )
        return null
    }
     /* Old way to edit a post */
    // deprecated: [{
    //     attributes: {           
    //         skyColor: {type: "string"},
    //         grassColor: {type: "string"}
    //     },
    //     save: function(props) {
    //         return (
    //             <h3>Today the sky is <span className="skyColor">{props.attributes.skyColor}</span>  and the grass is <span className="grassColor">{props.attributes.grassColor}</span></h3>
              
    //         )
    //     },
    // },{
    //     attributes: {           
    //         skyColor: {type: "string"},
    //         grassColor: {type: "string"}
    //     },
    //     save: function(props) {
    //         return (
    //             <p>Today the sky is <span className="skyColor">{props.attributes.skyColor}</span>  and the grass is <span className="grassColor">{props.attributes.grassColor}</span></p>
              
    //         )
    //     }
    // }]
})

function EditComponent(props) {
    /* Old functions */
    // return wp.element.createElement("h3", null, "Hello, this is from the admin editor screen.")
    // function updateSkyColor(event) {
    //     props.setAttributes({skyColor: event.target.value})
    // }

    // function updateGrassColor(event) {
    //     props.setAttributes({grassColor: event.target.value})
    // }

    /* This const helps to emulate the plugin as before */
    const blockProps = useBlockProps({
        className: "paying-attention-edit-block",
        style: { backgroundColor: props.attributes.bgColor }
    })

    function updateQuestion(value) {
        props.setAttributes({question: value})
    }

    function deleteAnswer(indexToDelete) {
        const newAnswers = props.attributes.answers.filter(function(x, index) {
            return index != indexToDelete
        })
        props.setAttributes( {answers: newAnswers} )

        if (indexToDelete == props.attributes.correctAnswer ) {
            props.setAttributes({correctAnswer: undefined})
        }
    }

    function markAsCorrect(index) {
        props.setAttributes( {correctAnswer: index} )
    }


    return (
        /* Old div that used the plugin to work in a similar way  */
        // <div className="paying-attention-edit-block" style={{backgroundColor: props.attributes.bgColor}} >
        <div {...blockProps} >
            <BlockControls>
                <AlignmentToolbar value={ props.attributes.theAlignment } onChange={x => props.setAttributes( {theAlignment: x} )} />
            </BlockControls>
            <InspectorControls>
                <PanelBody title="Background Color" initialOpen={true}>
                    <PanelRow>
                    {/* Old appearance of the color picker */}
                    {/* <ColorPicker color={props.attributes.bgColor} onChangeComplete={ x => props.setAttributes({bgColor: x.hex}) } /> */}
                        <ChromePicker color={props.attributes.bgColor} onChangeComplete={ x => props.setAttributes({bgColor: x.hex}) } disableAlpha={true} />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{ fontSize: "20px" }} />
            <p style={{ fontSize:"13px", margin:"20px 0 8px 0" }}>Answers:</p>
            {props.attributes.answers.map(function(answer, index) {
                return (
                    <Flex>
                        <FlexBlock>
                            <TextControl autoFocus={answer == undefined} value={answer} onChange={newValue => {
                                const newAnswers = props.attributes.answers.concat([])
                                newAnswers[index] = newValue
                                props.setAttributes({answers: newAnswers})
                            } } />
                        </FlexBlock>
                        <FlexItem>
                            <Button onClick={() => markAsCorrect(index)} >
                                <Icon className="mark-as-correct" icon={ props.attributes.correctAnswer == index ? "star-filled" : "star-empty" } />
                            </Button>
                        </FlexItem>
                        <FlexItem>
                            <Button isLink className="attention-delete" onClick={ () => deleteAnswer(index) } >Delete</Button>
                        </FlexItem>
                    </Flex>
                )
            }) }
            <Button isPrimary onClick={ () => {              
                props.setAttributes( {answers: props.attributes.answers.concat([undefined]) } )
            } } >Add another answer</Button>
        </div>
    )
}
