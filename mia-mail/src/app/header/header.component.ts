import { Component, EventEmitter, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  isLoading = false;

  @Output() updateUrl = new EventEmitter<string>();

  baseUrl = 'https://vulnwatch-development.ts.r.appspot.com/';

  constructor() { }

  ngOnInit(): void {
  }

  onChangeUrl() {
    this.updateUrl.emit(this.baseUrl);
  }
}
