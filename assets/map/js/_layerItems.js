function Map(api_url, base_url, lang, area_code) {
    this.api_url = api_url;
    this.base_url = base_url;
    this.lang = lang;
    this.area_code = area_code;
    this.project_link = api_url + lang + "/all-geojson-municipality-projects";
    this.point_of_interest_link = api_url + lang + "/point-of-interest/geojson";
}

function Demography(map,areas,indicator){
    console.log(base_url);
    this.map = map;
    this.base_url = base_url + "datasearch/tldp/";
    this.url_population_size = this.base_url + "en/api/dashboardapi/get-map-data/517/mrd/TLS/undefined/undefined/1";
    this.url_population_density = this.base_url + "en/api/dashboardapi/get-map-data/344/mrd/TLS/undefined/undefined/1"
}


Demography.prototype.renderPopulationSize = function(){
    $.ajax({
        url:this.url_population_size,
        type:"get",
        success:function(response){
            console.log(response);
        }
    })
}

Demography.prototype.renderPopulationDensity = function (){
    $.ajax({
        url:this.url_population_density,
        type:"get",
        success:function(response){
            console.log(response);
        }
    })
}

