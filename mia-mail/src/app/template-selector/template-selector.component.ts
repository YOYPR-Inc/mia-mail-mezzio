import { Component, OnInit } from '@angular/core';
import MIATemplate from '../entities/template';
import { TemplateService } from '../services/template.service';

@Component({
  selector: 'app-template-selector',
  templateUrl: './template-selector.component.html',
  styleUrls: ['./template-selector.component.scss']
})
export class TemplateSelectorComponent implements OnInit {

  templates: Array<MIATemplate> = [];

  constructor(
    protected templateService: TemplateService
  ) { }

  ngOnInit(): void {
  }

  refreshTemplates() {
    this.templateService.fetchAllTemplates().then(data => {
      this.templates = data;
    }).catch(er => {
      alert('No se pudo cargar');
    });
  }
}
