$("#package_select").select2();

if(userPackage) {
    $('#package_select').val(userPackage);
    $('#package_select').select2().trigger('change');
}
