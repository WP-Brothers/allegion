module.exports = {
  plugins: ["stylelint-scss", "stylelint-order"],
  extends: [
    "stylelint-config-standard",
    "stylelint-config-standard-scss",
    "stylelint-config-rational-order"
  ],
  rules: {
    indentation: 2,
    "number-leading-zero": "never",
    "string-quotes": "double",
    "selector-max-id": 8,
    "selector-list-comma-newline-after": "always",
    "rule-empty-line-before": ["always", {ignore: ["after-comment"]}],
    "comment-empty-line-before": ["always", {except: ["first-nested"]}],
    "block-opening-brace-space-before": "always",
    "declaration-colon-space-after": "always",
    "declaration-colon-space-before": "never",
    "declaration-block-single-line-max-declarations": 1,
    "declaration-property-value-disallowed-list": {"/^border/": ["none"]},
    "at-rule-empty-line-before": [
      "always",
      {ignore: ["after-comment"], except: ["first-nested"]},
    ],

    // Sass rules
    "max-nesting-depth": 8,
    "scss/dollar-variable-pattern": "^_?[a-z]+[\\w-]*$",
    "scss/at-extend-no-missing-placeholder": null,
    "order/order": [
      [
        "dollar-variables",
        "custom-properties",
        "at-variables",
        "declarations",
        "at-rules",
        "rules",
      ],
      {
        unspecified: "bottom",
      },
    ],
    "plugin/rational-order": [true],
  },
  ignorePath: ".gitignore",
};
