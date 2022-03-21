<?php


?>

<style>
  .form__great__wrapper {
    height: 100vh !important;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .button_custom {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid black;
    background-color: <?= $color; ?>;
    color: white;
    font-weight: 800;
    text-transform: uppercase;
    transition: opacity 0.3s ease;
  }

  .form__great__wrapper {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .button_custom:hover {
    opacity: 0.5;
  }
</style>