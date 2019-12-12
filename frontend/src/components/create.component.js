import React, { Component } from 'react'
import axios                from 'axios'
import { Redirect }         from 'react-router-dom'

export default class Create extends Component {
  constructor (props) {
    super(props)
    this.onChangeAvatar = this.onChangeAvatar.bind(this)
    this.onChangeNome = this.onChangeNome.bind(this)
    this.onChangeEndereco = this.onChangeEndereco.bind(this)
    this.onSubmit = this.onSubmit.bind(this)

    this.state = {
      avatar: '',
      nome: '',
      endereco: ''
    }
  }

  onChangeAvatar (e) {
    this.setState({
      avatar: e.target.value
    })
  }

  onChangeNome (e) {
    this.setState({
      nome: e.target.value
    })
  }

  setRedirect = () => {
    this.setState({
      redirect: true
    })
  }

  renderRedirect = () => {
    if (this.state.redirect) {
      return <Redirect to='/index'/>
    }
  }

  onChangeEndereco (e) {
    this.setState({
      endereco: e.target.value
    })
  }

  async onSubmit (e) {
    e.preventDefault()
    const obj = {
      avatar: this.state.avatar,
      nome: this.state.nome,
      endereco: this.state.endereco
    }
    await axios.post(`http://localhost:8080/alunos`, obj)
      .then(res => {
        this.props.history.push('/index')
      })
      .catch(e => console.log('erro :' + e))

  }

  render () {
    return (
      <div style={ {marginTop: 10} }>
        <h3>Adicionar Aluno</h3>
        <form onSubmit={ this.onSubmit }>
          <div className="form-group">
            <label>Avatar: </label>
            <input
              type="text"
              className="form-control"
              value={ this.state.avatar }
              onChange={ this.onChangeAvatar }
            />
          </div>
          <div className="form-group">
            <label>Nome: </label>
            <input type="text"
                   className="form-control"
                   value={ this.state.nome }
                   onChange={ this.onChangeNome }
            />
          </div>
          <div className="form-group">
            <label>Endereco: </label>
            <input type="text"
                   className="form-control"
                   value={ this.state.endereco }
                   onChange={ this.onChangeEndereco }
            />
          </div>
          <div className="form-group text-center">
            { this.renderRedirect() }
            <input type="button"
                   value="Voltar"
                   onClick={ this.setRedirect }
                   className="btn btn-danger mx-4"/>
            <input type="submit" value="Adicionar" className="btn btn-primary"/>
          </div>
        </form>
      </div>
    )
  }
}