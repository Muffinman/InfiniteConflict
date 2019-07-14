<template>
    <div>
        <svg width="100%" height="100%" :viewBox="viewBox" version="1.1" xmlns="http://www.w3.org/2000/svg" :style="styles">
            <path :d="path" style="fill:#0a2129; fill-opacity:0.85; stroke:#6ddbf5; stroke-width:1px;" />
            <path :d="buttonPath" style="fill:#6ddbf5; fill-opacity:1;" />
        </svg>
        <div ref="boxContent" class="box-content" style="position: relative; z-index: 1">
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
                strokeSize: 2,
                chunkWidth: 120,
                chunkHeight: 30,
                chunkSlopeWidth: 30,
                bezel: 15,
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
            viewBox() {
                return `0 0 ${this.bounds.width} ${this.bounds.height}`
            },
            path() {
                return `M ${this.bounds.width - this.bezel},0
                    l -${this.bounds.width - (this.bezel * 2)},0
                    l -${this.bezel},${this.bezel}
                    l 0,${this.bounds.height - (this.bezel * 2)}
                    l ${this.bezel},${this.bezel}
                    l ${this.bounds.width - this.chunkSlopeWidth - this.chunkWidth - this.bezel},0
                    l ${this.chunkSlopeWidth},-${this.chunkHeight}
                    l ${this.chunkWidth},0
                    l 0,-${this.bounds.height - this.chunkHeight - this.bezel}
                    Z`;
            },
            buttonPath() {
                return `M ${this.bounds.width - this.chunkSlopeWidth},${this.bounds.height}
                    l ${this.chunkSlopeWidth},-${this.chunkHeight - 3}
                    l -${this.chunkWidth - 3},0
                    l -${this.chunkSlopeWidth},${this.chunkHeight}
                    Z`
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
