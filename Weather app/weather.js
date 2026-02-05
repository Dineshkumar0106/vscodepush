//=================================================================================================//
//Weather App using OpenWeatherMap API
//=================================================================================================//



// creating api url with the api key
const apiurl = "https://api.openweathermap.org/data/2.5/weather?&units=metric&q=";
const apikey="18f2926f25eb1904fa572df349ae6c21";
// const newurl=apiurl+"chennai"+`&appid=${apikey}`;


//=================================================================================================//
// creating the values from the input types

const searchbox = document.querySelector(".search input");
const searchbtn = document.querySelector(".search button");
// const weathericon = document.querySelector(".weather-icon")


//=====================================================================================================//
// function for extrating city by pressing enter and the search icon
let city="";

// when button is clicked
searchbtn.addEventListener("click",() => {
    result(searchbox.value);
    document.querySelector(".card").style.display="block";
    document.querySelector(".map-card").style.display="block";
})

// when press enter key
searchbox.addEventListener("keydown",(event)=>{
    if (event.key === "Enter"){
        result(searchbox.value);
        document.querySelector(".card").style.display="block";
        document.querySelector(".map-card").style.display="block";
    }
    
})

// extraction of city name

async function result(city) {
    city = searchbox.value.trim();
    // console.log("city:",city);
    const weather_url = apiurl+city+`&appid=${apikey}`;
    console.log(weather_url);
    

//============================================================================================================================//
// make the information in readable format using json
    // without ***await fetch***
    //  It will return only the link and not read the information from the link
    
    // const wait = apiurl+city+`&appid=${apikey}`;


    // with ***await fetch***
    //  It will intract with the link and read the information and stored to the individual values

    const wait = await fetch(weather_url);
    const data = await wait.json();
    if(city == ""){

        document.querySelector(".error").innerHTML="City name must not be blank.";
        document.querySelector(".weather").style.display="none";
        document.querySelector(".error").style.display="block";
        document.querySelector(".map-card").style.display="none";
        document.querySelector(".card").style.display="none";
        // document.querySelector(".card").style.padding="20px auto 0";
    }

    else if (wait.status==404){
        document.querySelector(".error").innerHTML="Invalid city name.";
        document.querySelector(".weather").style.display="none";
        document.querySelector(".error").style.display="block";
        document.querySelector(".map-card").style.display="none";
        document.querySelector(".card").style.display="none";
        // document.querySelector(".card").style.padding="20px auto 0";
    }
    else{
        document.querySelector(".error").style.display="none";
        document.querySelector(".weather").style.display="block";
    
    console.log(data);
    console.log(data.name);
    document.querySelector(".city").innerHTML=data.name;
    document.querySelector(".temp").innerHTML=data.main.temp+"°c";
    document.querySelector(".humidity").innerHTML=data.main.humidity+"%";
    document.querySelector(".wind").innerHTML=data.wind.speed+"km/hr";
    // console.log("Inside click: ",city);


//==========================================================================================================//
    // to set the image based on the temperature
    const main = data.weather[0].main;    
    console.log(main);
    const weathericon =  document.querySelector(".weather_icon");
    if(main == "Mist"){
        weathericon.src="image/mist.png";
    }
    else if(main == "Clear"){
        weathericon.src="image/clear.png";
    }
    else if(main == "Clouds"){
        weathericon.src="image/clouds.png";
    }
    else if(main == "Drizzle"){
        weathericon.src="image/drizzle.png";
    }
    else if(main == "Fog"){
        weathericon.src="image/fog.png";
    }
    else if(main == "Haze"){
        weathericon.src="image/haze.png";
    }
    else if(main == "Rain"){
        weathericon.src="image/rain.png";
    }
    else if(main == "Smoke"){
        weathericon.src="image/smoke.png";
    }
    else if(main == "Snow"){
        weathericon.src="image/snow.png";
    }
    


//=================================================================================================//
    // Date and time extraction

    // It is not user freindly for current time where the time update for 10 to 20 mins once
    // Time will be fetch using different method
   //==============================================================================================// 
    // extract date and time and convert it into unix second to readable time
    // const unixdate =data.dt+data.timezone-19800;
    // // console.log(unixdate);
    // const datetime=new Date(unixdate*1000);
    // console.log(datetime.toLocaleDateString());
    // console.log(datetime.toLocaleTimeString());
    // document.querySelector(".pdate").innerHTML=datetime.toLocaleDateString();
    // document.querySelector(".ptime").innerHTML=datetime.toLocaleTimeString();


// ================================================================================================================//
    // Time and date 
    
    // It will be find by another API with same url and key
    // Reqiurement => url, key, longitude and lattitude
    // longitude and latitude are extract from the weather api

    // const lat = data.coord.lat;
    // const lon = data.coord.lon;
    // const tz_url = `https://api.timezonedb.com/v2.1/get-time-zone?key=F3GADC50C6TF&format=json&by=position&lat=${lat}&lng=${lon}`;
    // console.log(tz_url);

    // // fetch the information from the url using await
    // const tz_link = await fetch(tz_url);
    // const tz_json = await tz_link.json();
    // console.log(tz_json);
    // const unixdate = tz_json.timestamp;
    // console.log(unixdate);
    // const datetime=new Date(unixdate*1000);
    // const zonename = tz_json.zoneName;
    // console.log(datetime.toLocaleDateString("en-GB",{ timeZone: zonename }));
    // console.log(datetime.toLocaleTimeString("en-GB",{ timeZone: zonename, hour:"2-digit", minute: "2-digit", second:"2-digit", hour12: false }));
    // document.querySelector(".pdate").innerHTML=datetime.toLocaleDateString("en-GB",{ timeZone: zonename });
    // document.querySelector(".ptime").innerHTML=datetime.toLocaleTimeString("en-GB",{ timeZone: zonename, hour:"2-digit", minute: "2-digit", second:"2-digit", hour12: false });

  //=================================================================================================//
    // 

    const lat = data.coord.lat;
    const lon = data.coord.lon;

    console.log(lat,lon);
    

//================================================================================================//
    // Map integration using Google map embed link

    city = searchbox.value.trim();
    const mapFrame = document.querySelector(".map");
    console.log("city:",city);
    const map_src = `https://www.google.com/maps?q=${lat},${lon}&z=10&output=embed`;
    console.log(map_src);
    document.querySelector(".map").src = map_src;
    //
    // document.getElementsByClassName("map").src = ;
    
    

    // time zone

    const tz_url = `https://api.timezonedb.com/v2.1/get-time-zone?key=F3GADC50C6TF&format=json&by=position&lat=${lat}&lng=${lon}`;
    console.log(tz_url);
    const tz_link = await fetch(tz_url);
    const tz_json = await tz_link.json();
    const timezone = tz_json.zoneName;
    console.log(timezone);
    
    const timestamp = (tz_json.timestamp-19800)*1000; // it containts only seconds
    const cur_time = new Date(); // It store in the extended time format
    console.log(cur_time);
    console.log("default=>",new Date(timestamp));
    
    console.log(timestamp);
    // console.log(timestamp.toLocaleTimeString()); ***it only runs with the extended time format not in seconds
    // console.log(timestamp.toLocaleString());

    const dateObj = new Date(timestamp);

    const date = dateObj.toLocaleDateString();
    const time = dateObj.toLocaleTimeString();

    console.log("Date:", date); 
    console.log("Time:", time);


    document.querySelector(".pdate").innerHTML=date;
    document.querySelector(".ptime").innerHTML=time;
}
}









//=================================================================================================//
//Map integration using OpenStreetMap Nominatim API
//=================================================================================================//
// function to load the map based on the city name
// async function result(city){
//     city = searchbox.value.trim();
//     const mapFrame = document.querySelector(".map");
//     console.log("city:",city);
//     document.getElementsByClassName("map").src = `https://www.google.com/maps?q=${lat},${lon}&output=embed`;
// }