function showLogin() {
    $('#frame').toggleClass('blur');
    $('#login-container').toggleClass('hidden');
}

function showUpload() {
    $('#frame').toggleClass('blur');
    $('#upload-container').toggleClass('hidden');
}

function updateTags() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText)["results"][0]["result"]);
            var txt = "";
            var arry = JSON.parse(this.responseText)["results"][0]["result"]["tag"]["classes"];
            for (var i = 0; i < 4; i++) {
                txt += "#" + arry[i] + " ";
            }
            $('#upload-tags').val(txt);
        }
    };
    xmlhttp.open("GET", "https://api.clarifai.com/v1/tag?url=" + $('#upload-url').val() + "&access_token=Qi5qu4mYmuGl2jgNVwjfiZoS2oTOTe", false);
    xmlhttp.send();
}

function showAds(tags, index) {

    tags.slice(0, tags.length-1);
    tags = tags.replace(/#/g, '$');

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var data;
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = this.responseText;
            $('#image-ads-' + index).html(data);
            $('#image-ads-' + index).animate({
                height: '220px',
                padding: '20px'
            }, 300);

        }
    };
    xmlhttp.open("GET", "generateAds.php?tags=" + tags, true);
    xmlhttp.send();
}
