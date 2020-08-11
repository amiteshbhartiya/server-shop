import React from 'react';
import './style.css'; 

//const storage = ['0GB', '250GB', '500GB', '1TB', '2TB', '3TB', '4TB', '8TB', '12TB', '24TB', '48TB', '72TB']
const storage = ['0', '250', '500', '1TB', '2TB', '3TB', '4TB', '8TB', '12TB', '24TB', '48TB', '72TB']
const storageTyle = ['SAS','SATA','SSD'];
const ram = [{value : '2GB', isChecked: false}, {value : '4GB', isChecked: false}, {value : '8GB', isChecked: false}, {value : '12GB', isChecked: false}, {value : '16GB', isChecked: false},  {value : '24GB', isChecked: false}, {value : '32GB', isChecked: false}, {value : '48GB', isChecked: false}, {value : '64GB', isChecked: false}, {value : '96GB', isChecked: false}]
const location = ['AmsterdamAMS-01','Washington D.C.WDC-01','San FranciscoSFO-12','SingaporeSIN-11', 'DallasDAL-10','FrankfurtFRA-10','Hong KongHKG-10']

const SearchForm = ({
    minSearchRange,
    maxSearchRange,
    searchHardisk,
    searchLocation,
    searchRam,
    onSearchInput,
    onMinSearchRange,
    onMaxSearchRange,
    onSearchHardDisk,
    onSearchLocation,
    onSearchRam,
    onSearchSubmit,
  }) =>{
    return (
      
    <form onSubmit={onSearchSubmit}>
        <div className = 'div-range'>
            <label htmlFor="range-storage-min">Storage(min range):</label>
             <input
                type="range" 
                value={minSearchRange} 
                onChange={onMinSearchRange}
                list="tickmarks"
                id="range-storage-min">
            </input>
            <label htmlFor="range-storage-max">Storage(max range):</label>
             <input
                type="range" 
                value={maxSearchRange} 
                onChange={onMaxSearchRange}
                list="tickmarks"
                id="range-storage-max">
            </input>
            <datalist id="tickmarks">
                <option value="0" label="0%"></option>
                <option value="10"></option>
                <option value="20"></option>
                <option value="30"></option>
                <option value="40"></option>
                <option value="50" label="50%"></option>
                <option value="60"></option>
                <option value="70"></option>
                <option value="80"></option>
                <option value="90"></option>
                <option value="100" label="100%"></option>
            </datalist>
        </div>
        <div className = 'div-selectbox'>
        <label htmlFor="hardisk">Hardisk Type</label>
        <select 
            value={searchHardisk} 
            name="hardisk"
            id="hardisk" 
            onChange={onSearchHardDisk}
        >
            <option value="">-- Please Choose a hardisk Type --</option>
            {storageTyle.map(item => (
            <option
                key={item}
            >
            {item}
            </option>
            ))}
        </select>
        <label htmlFor="location">Location</label>
        <select 
            value={searchLocation} 
            name="location" 
            id="location"
            onChange={onSearchLocation}
        >
            <option value="">-- Please Choose a Location --</option>
            {location.map(item => (
            <option
                key={item}
            >
            {item}
            </option>
            ))}
        </select>
        </div>
        <div className = 'div-checkbox-container'>
            <div className="div-checkbox-header">Ram Size</div>
            <div className ="div-checkbox">
                {ram.map(item => { 
                    // let index = ("'"+item.value.trim()+"'"); 
                    // console.log(typeof searchRam);
                    // console.log(searchRam[index]) //return false;
                    return (

                <label  key={item.value}><input type="checkbox" name='ram' checked={searchRam[item.value]}  key={item.value}  value={item.value} onChange={onSearchRam} />{item.value} </label>
            
                )}
                )}
            </div>
        </div>
    
        <div className = 'div-submit'>
            <button type="submit">
                Submit
            </button>
        </div>
    </form>
  );
};
  export default SearchForm
  