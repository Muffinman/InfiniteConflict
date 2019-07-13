<template>
    <div>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" :style="styles" :viewBox="viewBox" preserveAspectRatio="none">
            <defs>
                <linearGradient x1="11.8748878%" y1="0%" x2="88.1251154%" y2="100%" id="linearGradient-1">
                    <stop stop-color="#6ddbf5" offset="20%" />
                    <stop stop-color="#ffffff" offset="50%" />
                    <stop stop-color="#6ddbf5" offset="100%" />
                </linearGradient>
            </defs>
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g stroke="url(#linearGradient-1)" :stroke-width="strokeSize" stroke-location="outside">
                    <path vector-effect="non-scaling-stroke" fill="#0a2129CC" :d="path"></path>
                </g>
            </g>
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
                height: 100,
                strokeSize: 2,
                chunkWidth: 80,
                chunkHeight: 50,
                chunkSlopeWidth: 50,
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
                    position: "absolute",
                    zIndex: 0,
                }
            },
            viewBox() {
                return `0 0 ${this.bounds.width} ${this.bounds.height}`
            },
            path() {
                return `M${this.bounds.width - this.strokeSize},${this.strokeSize}
                  L${this.strokeSize},${this.strokeSize}
                  L${this.strokeSize},${this.bounds.height - this.strokeSize}
                  L${this.bounds.width - this.chunkSlopeWidth - this.chunkWidth},${this.bounds.height - this.strokeSize}
                  L${this.bounds.width - this.chunkWidth},${this.bounds.height - this.chunkHeight}
                  L${this.bounds.width - this.strokeSize},${this.bounds.height - this.chunkHeight}
                  Z`;
            }
        },
        mounted() {
            this.height = this.$refs.boxContent.clientHeight;
        }
    }
</script>
