import React from 'react';

const List = React.memo(({ list }) =>
list.map(item => (
  <Item
    key={item.id}
    item={item}
  />
))
);

const Item = ({ item }) => (
<div> 
  <span > {item.model}</span>
  <span >{item.hardisk}</span>
  <span >{item.ram}</span>
  <span >{item.location}</span>
  <span >{item.price}</span>
</div>
);

export default List