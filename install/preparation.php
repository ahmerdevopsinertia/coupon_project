<?php

function install_preparation() {

    @chmod( THEMES_LOC, 0777 );
    @chmod( UPLOAD_IMAGES_LOC, 0777 );
    @chmod( COMMON_LOCATION, 0777 );
    @chmod( TEMP_LOCATION, 0777 );
    @chmod( UPDIR, 0777 );
    @chmod( 'install', 0777 );
    @chmod( 'settings.php', 0777 );

    if( is_writable( THEMES_LOC ) && is_writable( UPLOAD_IMAGES_LOC ) && is_writable( COMMON_LOCATION ) && is_writable( TEMP_LOCATION ) && is_writable( UPDIR ) && is_writable( 'install' ) && is_writable( 'settings.php' ) ) {
        return true;
    }

    return false;

}