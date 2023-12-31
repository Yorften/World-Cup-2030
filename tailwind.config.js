/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./getContent.php",
    "src/pages/getCountryInfo.php",
    "src/pages/footer.html",
    "src/pages/header.html",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require("daisyui"),
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
