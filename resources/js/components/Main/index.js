import React from 'react';
import axios from 'axios';
import SearchForm from '../Form/index'
import List from '../List/index'
import { pickBy, keys } from 'lodash';
import './style.css'; 

const API_ENDPOINT = 'http://127.0.0.1:8001/api/v1/search?';

const useSemiPersistentState = (key, initialState) => {
  const isMounted = React.useRef(false);
  const [value, setValue] = React.useState(
    localStorage.getItem(key) || initialState
  );

  React.useEffect(() => {
    if (!isMounted.current) {
      isMounted.current = true;
    } else {
      localStorage.setItem(key, value);
    }
  }, [value, key]);

  return [value, setValue];
};

const storiesReducer = (state, action) => {
  switch (action.type) {
    case 'STORIES_FETCH_INIT':
      return {
        ...state,
        isLoading: true,
        isError: false,
      };
    case 'STORIES_FETCH_SUCCESS':
      return {
        ...state,
        isLoading: false,
        isError: false,
        data: action.payload,
      };
    case 'STORIES_FETCH_FAILURE':
      return {
        ...state,
        isLoading: false,
        isError: true,
      };
    default:
      throw new Error();
  }
};

const getSumComments = stories => {
  return stories.data.reduce(
    (result, value) => result + value.id,
    0
  );
};

const App = () => {
  const [minSearchRange, setMinSearchRange] = useSemiPersistentState(
    'minStorage',
    0
  );

 const [maxSearchRange, setMaxSearchRange] = useSemiPersistentState(
    'maxStorage',
    100
  );

  const [searchHardisk, setSearchHardisk] = useSemiPersistentState(
    'hardisk',
    ''
  );

  const [searchLocation, setSearchLocation] = useSemiPersistentState(
    'location',
    ''
  );

  const [searchRam, setSearchRam] = useSemiPersistentState(
    'ram',
    '{"2GB" : false, "4GB" : false, "8GB" : false, "12GB" : false, "16GB" : false, "24GB" : false, "32GB" : false, "48GB" : false, "64GB" : false, "96GB" : false}'
    //[{value : '2GB', isChecked: false}, {value : '4GB', isChecked: false}, {value : '8GB', isChecked: false}, {value : '12GB', isChecked: false}, {value : '16GB', isChecked: false},  {value : '24GB', isChecked: false}, {value : '32GB', isChecked: false}, {value : '48GB', isChecked: false}, {value : '64GB', isChecked: false}, {value : '96GB', isChecked: false}]
  );

  const [url, setUrl] = React.useState(
    `${API_ENDPOINT}`
  );

  const [stories, dispatchStories] = React.useReducer(
    storiesReducer,
    { data: [], isLoading: false, isError: false }
  );

  const handleFetchStories = React.useCallback(async () => {
    dispatchStories({ type: 'STORIES_FETCH_INIT' });

    try {
      const result = await axios.get(url);

      //console.log(result); return false;

      dispatchStories({
        type: 'STORIES_FETCH_SUCCESS',
        payload: result.data.data,
      });
    } catch {
      dispatchStories({ type: 'STORIES_FETCH_FAILURE' });
    }
  }, [url]);

  React.useEffect(() => {
    handleFetchStories();
  }, [handleFetchStories]);

  const handleMinSearchRange = event => {
    setMinSearchRange(event.target.value);
  };
  
  const handleMaxSearchRange = event => {
    setMaxSearchRange(event.target.value);
  };
  const handleSearchHardisk = event => {
    setSearchHardisk(event.target.value);
  };
  const handleSearchLocation = event => {
    setSearchLocation(event.target.value);
  };

  const handleSearchRam= event => {
    //setSearchLocation(event.target.value);
    const {name, value, type, checked} = event.target
    if(name === 'ram'){
        let jsonData = JSON.parse(searchRam);

       let updatedJson = {
            ...jsonData,
            [value] : !jsonData[value]
        }

        setSearchRam(JSON.stringify(updatedJson))
    }
  };


  const handleSearchSubmit = event => {
    var selectedRam = keys(pickBy(JSON.parse(searchRam)));
    const params = new URLSearchParams({
        minStorage: minSearchRange,
        maxStorage: maxSearchRange,
        hardisk: searchHardisk,
        location: searchLocation,
        ram: selectedRam,
      });
      console.log(params.toString());
    setUrl(`${API_ENDPOINT}${params.toString()}`);

    event.preventDefault();
  };

  const sumComments = React.useMemo(() => getSumComments(stories), [
    stories,
  ]);

  return (
    <div className="grid-main-container">
      <div className = "count-container">We have got {stories.isLoading? 0: stories.data.length } search results.</div>
      <div className ="filter-container">
      <SearchForm
        minSearchRange={minSearchRange}
        maxSearchRange={maxSearchRange}
        searchHardisk={searchHardisk}
        searchLocation={searchLocation}
        searchRam={JSON.parse(searchRam)}
        onMinSearchRange={handleMinSearchRange}
        onMaxSearchRange={handleMaxSearchRange}
        onSearchHardDisk={handleSearchHardisk}
        onSearchLocation={handleSearchLocation}
        onSearchRam={handleSearchRam}
        onSearchSubmit={handleSearchSubmit}
      />

      </div>
      <div className="list-container">

        {stories.isError && <p>Something went wrong ...</p>}

        {stories.isLoading ? (
          <p>Loading ...</p>
        ) : (
          <div className = 'list-container-dummy table table-dark'>
          <div className = "list-header row">
            <div>Model</div>
            <div>HDD</div>
            <div>RAM</div>
            <div>Location</div>
            <div>Price</div>
          </div>
            <div className = "list-body"> 
              <List list={stories.data} />
            </div>
          </div>
        )}
      </div>
    </div>
  );
};
export default App;
