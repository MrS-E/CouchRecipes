function v(newDoc, oldDoc, userCtx) {
    function require(field, message) {
        message = message || "Document must have a " + field;
        if (!newDoc[field]) throw({forbidden : message});
    }
    if(newDoc){
        require("name");
        require("category");
        require("date");
        require("ingredient");
        require("manual");
        require("image");
    }
}