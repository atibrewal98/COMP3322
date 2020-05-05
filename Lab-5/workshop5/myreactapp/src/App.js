import React, { Component } from 'react';
import $ from 'jquery';
class CommodityPage extends Component {
  constructor(props) {
    super(props);
    this.state = {
      commodities: [],
      filterText: '',
      showOutOfStockCommodity: true,
      newCommodityName: '',
      newCommodityCategory: '',
      newCommodityStatus: ''
    };

    this.handleFilterTextChange = this.handleFilterTextChange.bind(this);
    this.handleButtonClick = this.handleButtonClick.bind(this);
    this.handleNameChange = this.handleNameChange.bind(this);
    this.handleCategoryChange = this.handleCategoryChange.bind(this);
    this.handleStatusChange = this.handleStatusChange.bind(this);
    this.handleAddFormSubmit = this.handleAddFormSubmit.bind(this);
  }
  handleFilterTextChange(filterText) {
    this.setState({
      filterText: filterText
    });
  }

  handleNameChange(name) {
    this.setState({
      newCommodityName: name
    })
  }

  handleCategoryChange(category) {
    this.setState({
      newCommodityCategory: category
    })
  }

  handleStatusChange(status) {
    this.setState({
      newCommodityStatus: status
    })
  }

  handleButtonClick() {
    this.setState({
      showOutOfStockCommodity: !this.state.showOutOfStockCommodity
    })
  }
  componentDidMount() {
    this.loadCommodities();
  }

  handleAddFormSubmit(e) {
    alert("Add (" + this.state.newCommodityName + ", " + this.state.newCommodityCategory + ", " + this.state.newCommodityStatus + ") to the form");
    $.post("http://localhost:3001/users/addcommodity",
      {
        "category": this.state.newCommodityCategory,
        "name": this.state.newCommodityName,
        "status": this.state.newCommodityStatus
      },
      function (data, status) {
        if (data.msg === '') {
          let newcommodities = this.state.commodities;
          newcommodities.push({
            "category": this.state.newCommodityCategory,
            "name": this.state.newCommodityName,
            "status": this.state.newCommodityStatus
          });
          this.setState({
            commodities: newcommodities,
            newCommodityName: '',
            newCommodityCategory: '',
            newCommodityStatus: ''
          });
        } else
          alert(data.msg);
      }.bind(this)
    );
    e.preventDefault();
  }

  loadCommodities() {
    $.ajax({
      url: "http://localhost:3001/users/commodities",
      dataType: 'json',
      cache: false,
      success: function (data) {
        this.setState({ commodities: data });
      }.bind(this),
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }
  render() {
    return (
      <div>
        <SearchBar
          filterText={this.state.filterText}
          onFilterTextChange={this.handleFilterTextChange}
        />
        <CommodityTable
          commodities={this.state.commodities}
          filterText={this.state.filterText}
          showOutOfStockCommodity={this.state.showOutOfStockCommodity}
        />
        <ShowHideButton
          showOutOfStockCommodity={this.state.showOutOfStockCommodity}
          onButtonClick={this.handleButtonClick} />
        <p></p>
        <AddCommodityForm name={this.state.newCommodityName}
          category={this.state.newCommodityCategory}
          status={this.state.newCommodityStatus}
          onNameChange={this.handleNameChange}
          onCategoryChange={this.handleCategoryChange}
          onStatusChange={this.handleStatusChange}
          onFormSubmit={this.handleAddFormSubmit}
        />
      </div>
    );
  }
}
export default CommodityPage;

class SearchBar extends Component {
  constructor(props) {
    super(props);
    this.handleFilterTextChange = this.handleFilterTextChange.bind(this);
  }

  handleFilterTextChange(e) {
    this.props.onFilterTextChange(e.target.value);
  }

  render() {
    return (
      <form>
        <input
          type="text"
          placeholder="Search..."
          value={this.props.filterText}
          onChange={this.handleFilterTextChange}
        />
      </form>
    );
  }
}

class AddCommodityForm extends Component {
  constructor(props) {
    super(props);
    this.handleNameTextChange = this.handleNameTextChange.bind(this);
    this.handleCategoryTextChange = this.handleCategoryTextChange.bind(this);
    this.handleStatusTextChange = this.handleStatusTextChange.bind(this);
  }

  handleNameTextChange(e) {
    this.props.onNameChange(e.target.value);
  }

  handleCategoryTextChange(e) {
    this.props.onCategoryChange(e.target.value);
  }

  handleStatusTextChange(e) {
    this.props.onStatusChange(e.target.value);
  }

  render() {
    return (
      <form onSubmit = {this.props.onFormSubmit}>
        <label>Name: </label>
        <input
          type="text"
          placeholder="Name"
          value={this.props.name}
          onChange={this.handleNameTextChange}
        />
        <br></br>
        <label>Category: </label>
        <input
          type="text"
          placeholder="Category"
          value={this.props.category}
          onChange={this.handleCategoryTextChange}
        />
        <br></br>
        <label>Status: </label>
        <select 
          onChange = {this.handleStatusTextChange} 
          value = {this.props.status}
        >
          <option value="0"></option>
          <option value="in stock">in stock</option>
          <option value="out of stock">out of stock</option>
        </select>
        <br></br>
        <input type="submit" value="Submit" />
      </form>
    );
  }
}

class CommodityTable extends Component {
  render() {
    const filterText = this.props.filterText;
    const showOutOfStockCommodity = this.props.showOutOfStockCommodity;
    var rows = this.props.commodities.map((commodity) => {
      if (commodity.name.indexOf(filterText) === -1) {
        return null;
      }

      if (showOutOfStockCommodity || commodity.status === "in stock") {
        return (
          <CommodityRow
            commodity={commodity}
            key={commodity.name}
          />
        );
      }
      return null;
    });
    return (
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>{rows}</tbody>
      </table>
    );
  }
}


class CommodityRow extends Component {
  render() {
    const commodity = this.props.commodity;
    return (
      <tr>
        <td>{commodity.name}</td>
        <td>{commodity.category}</td>
        <td>{commodity.status}</td>
      </tr>
    );
  }
}

class ShowHideButton extends Component {
  constructor(props) {
    super(props);
    this.handleButtonClick = this.handleButtonClick.bind(this);
  }
  handleButtonClick() {
    this.props.onButtonClick();
  }
  render() {
    return (
      <button onClick={this.handleButtonClick}>
        {this.props.showOutOfStockCommodity ? 'Hide Out-of-Stock Commodity' : 'Show Out-of-Stock Commodity'}
      </button>
    );
  }
}