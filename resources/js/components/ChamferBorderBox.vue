<template>
    <div style="position:relative;">
        <svg width="100%" height="100%" :viewBox="viewBox" version="1.1" xmlns="http://www.w3.org/2000/svg" :style="styles">
            <path :d="path" style="fill:#0a2129; fill-opacity:0.9; stroke:#6ddbf5; stroke-width:1.5px;" />
        </svg>
        <svg :width="buttonsWidth" :height="buttonsHeight" :viewBox="buttonsViewBox" version="1.1" xmlns="http://www.w3.org/2000/svg" :style="buttonStyles">
            <devs>
                <path id="p1" :d="buttonTextPath" />
            </devs>
            <path :d="buttonPath" class="button" style="fill-opacity:1;" />
            <text style="font-size: 18px; font-family: Orbitron; pointer-events: none;">
                <textPath xlink:href="#p1" startOffset="50%" text-anchor="middle">OK</textPath>
            </text>
        </svg>
        <div ref="boxContent" class="box-content" style="position:relative; z-index:1">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                width: 600,
                height: 200,
                buttonsWidth: 120,
                buttonsHeight: 30,
                buttonsSlopeWidth: 20,
                bezel: 20,
            }
        },
        computed: {
            bounds() {
                return {
                    width: this.styles.width,
                    height: this.styles.height,
                }
            },
            styles() {
                return {
                    width: this.width,
                    height: this.height,
                    position: 'absolute',
                    zIndex: 0,
                    fillRule: 'evenodd',
                    clipRule: 'evenodd',
                    strokeLinejoin: 'round',
                    StrokeMiterLimit: 2,
                }
            },
            buttonStyles() {
                return {
                    zIndex: 2,
                    width: this.buttonsWidth + this.buttonsSlopeWidth,
                    height: this.buttonsHeight,
                    position: 'absolute',
                    bottom: 0,
                    right: 0,
                }
            },
            viewBox() {
                return `0 0 ${this.bounds.width} ${this.bounds.height}`
            },
            path() {
                return `M ${this.bounds.width - this.bezel},0
                    l -${this.bounds.width - (this.bezel * 2)},0
                    l -${this.bezel},${this.bezel}
                    l 0,${this.bounds.height - (this.bezel * 2)}
                    l ${this.bezel},${this.bezel}
                    l ${this.bounds.width - this.buttonsSlopeWidth - this.buttonsWidth - this.bezel},0
                    l ${this.buttonsSlopeWidth},-${this.buttonsHeight}
                    l ${this.buttonsWidth},0
                    l 0,-${this.bounds.height - this.buttonsHeight - this.bezel}
                    Z`;
            },
            buttonPath() {
                return `M ${this.buttonsWidth - this.buttonsSlopeWidth / 2},${this.buttonsHeight}
                    l ${this.buttonsSlopeWidth},-${this.buttonsHeight - 3}
                    l -${this.buttonsWidth - 3},0
                    l -${this.buttonsSlopeWidth},${this.buttonsHeight}
                    Z`
            },
            buttonTextPath() {
                return `M 0,${this.buttonsHeight - 8}
                        l ${this.buttonsWidth},0`;
            },
            buttonsBounds() {
                return {
                    width: this.buttonsWidth,
                    height: this.buttonsHeight,
                }
            },
            buttonsViewBox() {
                return `0 0 ${this.buttonsBounds.width} ${this.buttonsBounds.height}`
            }
        },
        mounted() {
            this.updateDimensions();
            window.onresize = this.updateDimensions;
        },
        methods: {
            updateDimensions() {
                this.height = this.$refs.boxContent.clientHeight;
                this.width = this.$refs.boxContent.clientWidth;
            }
        }
    }
</script>
