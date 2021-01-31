import { Component, OnInit } from '@angular/core';
import MIATemplate from '../entities/template';

@Component({
  selector: 'app-template-selector',
  templateUrl: './template-selector.component.html',
  styleUrls: ['./template-selector.component.scss']
})
export class TemplateSelectorComponent implements OnInit {

  templates: Array<MIATemplate> = [];

  constructor() { }

  ngOnInit(): void {
  }

}
