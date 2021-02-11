import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { MatSelectChange } from '@angular/material/select';
import MIATemplate from '../entities/template';
import { TemplateService } from '../services/template.service';

@Component({
  selector: 'app-template-selector',
  templateUrl: './template-selector.component.html',
  styleUrls: ['./template-selector.component.scss']
})
export class TemplateSelectorComponent implements OnInit {

  @Output() selectedTemplate = new EventEmitter<MIATemplate>();

  templates: Array<MIATemplate> = [];
  templateSelected: MIATemplate | undefined;

  constructor(
    protected templateService: TemplateService
  ) { }

  ngOnInit(): void {
  }

  onClickSave() {
    this.templateService.saveTemplate(this.templateSelected!).then();
  }

  onSelectTemplate(data: MatSelectChange) {
    this.templateSelected = data.value;
    this.selectedTemplate.emit(data.value);
  }

  refreshTemplates() {
    this.templateService.fetchAllTemplates().then(data => {
      this.templates = data;
    }).catch(er => {
      alert('No se pudo cargar');
    });
  }
}
