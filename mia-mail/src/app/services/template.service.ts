import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthenticationService, MiaAuthHttpService } from '@mobileia/authentication';
import MIATemplate from '../entities/template';

@Injectable({
  providedIn: 'root'
})
export class TemplateService extends MiaAuthHttpService {

  baseUrl = '';

  constructor(
    protected http: HttpClient,
    protected authService: AuthenticationService
  ) {
    super(http, authService);
  }

  fetchAllTemplates(): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail-admin/list', { });
  }

  saveTemplate(template: MIATemplate): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail-admin/save', template);
  }
}
