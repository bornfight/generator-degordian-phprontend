'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const path = require('path');
const mkdirp = require('mkdirp');

module.exports = class extends Generator {
  prompting() {
    // Have Yeoman greet the user.
    this.log(yosay(
      'Welcome to the ace ' + chalk.red('Degordian phprontend') + ' generator!'
    ));
    this.log(`Please enter the project's name. Supplying the name of the current folder will scaffold the application ${chalk.red('in the current folder')}.
Supplying a new name will create the folder for you.`);
    // Prompting the user
    const prompts = [{
      type: 'input',
      name: 'name',
      message: 'What is the name of the project?',
      validate: input => {
        return input.length > 0 ? true : 'Project name contains no characters.';
      }
    },
    {
      type: 'list',
      name: 'projectType',
      message: 'Is this project Yii or Wordpress based?',
      choices: ['Yii', 'Wordpress']
    }];

    return this.prompt(prompts).then(props => {
      // To access props later use this.props.someAnswer;
      this.props = props;
    });
  }

  createFolderIfDoesNotExist() {
    if (path.basename(this.destinationPath()) !== this.props.name) {
      this.log(`Creating a folder named ${this.props.name}`);
      mkdirp(this.props.name);
      this.destinationRoot(this.destinationPath(this.props.name));
    }
  }

  writing() {
    this.fs.copyTpl(
      this.templatePath('slice'),
      this.destinationPath('slice'),
      {
        name: this.props.name,
        projectType: this.props.projectType
      }
    );

    this.fs.copyTpl(
      this.templatePath('common/**'),
      this.destinationRoot(),
      {
        globOptions: {
          dot: true
        },
        name: this.props.name,
        projectType: this.props.projectType
      }
    );

    this.fs.copy(
      this.templatePath('dotfiles/**'),
      this.destinationRoot(),
      {
        globOptions: {
          dot: true
        }
      }
    );

    this.fs.copy(
      this.templatePath('static/**'),
      this.destinationPath('static'),
      {
        globOptions: {
          dot: true
        }
      }
    );
  }

  createDirectories() {
    mkdirp.sync(path.join(this.destinationPath(), 'static/dist'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/fonts'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/images'));

    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/base'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/components'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/frameworks'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/pages'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/functions'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/mixins'));
    mkdirp.sync(path.join(this.destinationPath(), 'static/scss/helpers/plugins'));
  }

  install() {
    this.installDependencies({
      npm: true,
      bower: false
    });
  }

  end() {
    // TODO: start dev server automagically
    // this.spawnCommand('npm run', ['dev']);
  }
};
