<template>
    <nav class="panel column is-offset-2 is-8">
        <p class="panel-heading">
            Vuejs Phonebook
            <button class="button is-link is-outlined">
                Add New<i class="fa fa-trash-alt"></i>
            </button>
        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
                <input class="input is-small" type="text" placeholder="search">
                <span class="icon is-small is-left">
        <i class="fa fa-search"></i>
      </span>
            </p>
        </div>

        <a class="panel-block">
        <span class="column is-9">
            marksheet
            </span>
            <div class="panel-icon column is-1"><i class="has-text-danger fa fa-trash" aria-hidden="true"></i></div>
            <div class="panel-icon column is-1"><i class="has-text-info fa fa-edit" aria-hidden="true"></i></div>
            <div class="panel-icon column is-1"><i class="has-text-primary fa fa-eye" aria-hidden="true"></i></div>
        </a></nav>

</template>