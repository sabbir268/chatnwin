<template>
  <hooper :settings="hooperSettings">
    <slide v-for="(member,i) in members" :key="i">
      <div class="item">
        <h1 class="chatroom-member-single" :style="`background: ${getRandomColor()}`">
          <span style="text-transform:uppercase">{{member.username.charAt(0)}}</span>
          <i
            class="fa fa-circle"
            :style="`color: ${member.is_online == 1 ? 'red' : '#ddd !important'}`"
            aria-hidden="true"
          ></i>
        </h1>
      </div>
    </slide>
  </hooper>
</template>

<script>
import { Hooper, Slide } from "hooper";
import "hooper/dist/hooper.css";

export default {
  props: ["members"],

  components: {
    Hooper,
    Slide,
  },
  data() {
    return {
      hooperSettings: {
        itemsToShow: 10,
        centerMode: true,
        breakpoints: {
          100: {
            centerMode: false,
            itemsToShow: 1,
          },
          300: {
            centerMode: false,
            itemsToShow: 3,
          },
          800: {
            centerMode: false,
            itemsToShow: 6,
          },
          1000: {
            itemsToShow: 8,
            pagination: "fraction",
          },
        },
      },
    };
  },

  methods: {
    getRandomColor() {
      var letters = "0123456789ABCDEF";
      var color = "#";
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    },
  },
};
</script>

<style >
.hooper {
  height: auto !important;
}
.hooper:focus {
  outline: none;
}
</style>